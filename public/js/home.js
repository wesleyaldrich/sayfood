document.addEventListener('DOMContentLoaded', () => {
    const carouselTrack = document.getElementById('carouselTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const items = carouselTrack ? Array.from(carouselTrack.querySelectorAll('.carousel-item-wrapper')) : [];

    const originalItemCount = laravelData.originalItemCount;
    const sliderTrack = document.getElementById('sliderTrack');
    const sliderThumb = document.getElementById('sliderThumb');

    if (!carouselTrack || items.length === 0 || originalItemCount === 0) {
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
        if (sliderTrack) sliderTrack.style.display = 'none';
        return;
    }

    const itemCount = items.length; // Total items including clones for infinite scroll
    let currentIndex = originalItemCount; // Start at the first "original" item
    let isScrolling = false;
    let autoScrollInterval;
    let isDraggingThumb = false;

    // --- Card Dragging Variables ---
    let isPointerDownOnTrack = false;
    let dragStartX = 0;
    let trackScrollLeftStart = 0;
    let dragStartTime = 0; // For differentiating click vs drag
    const CLICK_DRAG_THRESHOLD_MS = 200; // Milliseconds to differentiate click from drag

    const ITEMS_PER_VIEW = 4; // This seems to be a fixed value in your original code
                               // If it's dynamic, adjust getItemsPerView accordingly.

    const getItemsPerView = () => ITEMS_PER_VIEW; // Or implement dynamic calculation

    const updateSliderThumbVisuals = () => {
        if (!sliderThumb || !sliderTrack || !carouselTrack) return;
        const scrollableWidth = carouselTrack.scrollWidth - carouselTrack.clientWidth;
        if (scrollableWidth <= 0) {
            sliderThumb.style.left = `0px`;
            sliderThumb.style.visibility = 'hidden'; // Hide thumb if not scrollable
            return;
        }
        sliderThumb.style.visibility = 'visible'; // Show thumb if scrollable
        const scrollPercentage = carouselTrack.scrollLeft / scrollableWidth;
        const thumbTrackWidth = sliderTrack.clientWidth;
        const thumbWidth = sliderThumb.offsetWidth;
        let thumbLeft = scrollPercentage * (thumbTrackWidth - thumbWidth);
        thumbLeft = Math.max(0, Math.min(thumbLeft, thumbTrackWidth - thumbWidth));
        sliderThumb.style.left = `${thumbLeft}px`;
    };

    const determineCurrentIndexFromScroll = () => {
        if (items.length === 0 || !carouselTrack) return originalItemCount;

        const trackCenter = carouselTrack.scrollLeft + (carouselTrack.clientWidth / 2);
        let closestItemIndex = 0;
        let smallestDistance = Infinity;

        items.forEach((item, idx) => {
            const itemCenter = item.offsetLeft + (item.offsetWidth / 2);
            const distance = Math.abs(itemCenter - trackCenter);
            if (distance < smallestDistance) {
                smallestDistance = distance;
                closestItemIndex = idx;
            }
        });
        return closestItemIndex;
    };

    const scrollToIndex = (index, behavior = 'smooth', isDragEnd = false) => {
        if (isScrolling && behavior === 'smooth' && !isDragEnd) return;
        if (!items[index]) { // Fallback if target index is somehow invalid
            console.warn(`Attempted to scroll to invalid index: ${index}. Resetting.`);
            index = currentIndex; // Stay at current if target is bad
            if (!items[index]) index = originalItemCount; // Further fallback
            if (!items[index]) return; // Absolute fallback
        }

        isScrolling = behavior === 'smooth'; // Only set true for smooth programmatic scrolls
        currentIndex = index;
        const item = items[currentIndex];

        const itemWidth = item.offsetWidth;
        const trackWidth = carouselTrack.clientWidth;
        let scrollPosition = item.offsetLeft - ((trackWidth - itemWidth) / 2);

        const maxScroll = carouselTrack.scrollWidth - carouselTrack.clientWidth;
        scrollPosition = Math.max(0, Math.min(scrollPosition, maxScroll));

        carouselTrack.scrollTo({ left: scrollPosition, behavior: behavior });

        const scrollEndTime = behavior === 'smooth' ? 500 : (behavior === 'auto' ? 10 : 0); // Shorter for auto/instant

        if (behavior !== 'auto' || isDragEnd) { // For smooth scrolls or drag end, manage infinite loop reset
            setTimeout(() => {
                isScrolling = false;
                const currentLogicalIndex = currentIndex % originalItemCount;

                // Infinite loop check:
                // If we are in the "cloned" area at the beginning (for prev navigation)
                if (currentIndex < originalItemCount) {
                    currentIndex = currentLogicalIndex + originalItemCount;
                    scrollToIndex(currentIndex, 'auto'); // Jump without smooth scroll
                }
                // If we are in the "cloned" area at the end (for next navigation)
                else if (currentIndex >= originalItemCount * 2) {
                    currentIndex = currentLogicalIndex + originalItemCount;
                    scrollToIndex(currentIndex, 'auto'); // Jump without smooth scroll
                }
                updateSliderThumbVisuals();
            }, scrollEndTime);
        } else { // For 'auto' scrolls not at drag end, just update visuals
            updateSliderThumbVisuals();
            isScrolling = false; // Ensure isScrolling is reset for 'auto'
        }
    };

    const setupSliderThumb = () => {
        if (!sliderTrack || !sliderThumb || !carouselTrack) return;
        if (carouselTrack.scrollWidth <= carouselTrack.clientWidth) {
            sliderTrack.style.display = 'none'; // Hide slider if not enough content
            return;
        }
        sliderTrack.style.display = 'block'; // Show slider if scrollable

        const visibleContentRatio = carouselTrack.clientWidth / carouselTrack.scrollWidth;
        const thumbTrackWidth = sliderTrack.clientWidth;
        let newThumbWidth = Math.max(20, visibleContentRatio * thumbTrackWidth); // Min thumb width 20px
        newThumbWidth = Math.min(newThumbWidth, thumbTrackWidth); // Max thumb width is track width
        sliderThumb.style.width = `${newThumbWidth}px`;
        updateSliderThumbVisuals();
    };

    const scrollNext = () => {
        let targetIndex = currentIndex + 1; // Scroll one item at a time for smooth visual
        // If current index is within the last 'ITEMS_PER_VIEW' of the effective end
        // (originalItemCount * 2 is the start of the post-clones)
        // and we want to loop back to the beginning of the original items.
        if (currentIndex % originalItemCount === originalItemCount - 1) {
             // We are at the logical last item, loop to the first logical item.
             // The "first" logical item in our cloned setup is at originalItemCount.
             // To smoothly scroll "past" the end and appear at the beginning,
             // we target an item in the post-clones that corresponds to the first item.
            targetIndex = originalItemCount * 2; // This should be the first item in the post-clones
                                                 // which is a clone of items[0] or items[originalItemCount]
        } else if (currentIndex >= originalItemCount * 2) {
            // If we've already jumped to post-clones, continue from there
            targetIndex = currentIndex + 1;
        } else {
            targetIndex = currentIndex + 1;
        }
        scrollToIndex(targetIndex);
    };

    const scrollPrev = () => {
        let targetIndex = currentIndex - 1;
        // No special logical end for previous, the infinite loop logic in scrollToIndex handles it.
        scrollToIndex(targetIndex);
    };


    if (prevBtn) prevBtn.addEventListener('click', () => { stopAutoScroll(); scrollPrev(); startAutoScrollAfterInteraction(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { stopAutoScroll(); scrollNext(); startAutoScrollAfterInteraction(); });

    const AUTO_SCROLL_DELAY = 3000;
    const USER_INTERACTION_RESTART_DELAY = 5000; // Restart auto-scroll after 5s of inactivity

    let interactionTimeout;
    const startAutoScrollAfterInteraction = () => {
        clearTimeout(interactionTimeout);
        interactionTimeout = setTimeout(() => {
            startAutoScroll();
        }, USER_INTERACTION_RESTART_DELAY);
    };

    const startAutoScroll = () => {
        stopAutoScroll();
        autoScrollInterval = setInterval(() => {
            scrollNext();
        }, AUTO_SCROLL_DELAY);
    };

    const stopAutoScroll = () => clearInterval(autoScrollInterval);

    // --- Slider Thumb Dragging ---
    if (sliderThumb && sliderTrack && carouselTrack) {
        sliderThumb.addEventListener('pointerdown', (e) => {
            e.preventDefault(); // Prevent text selection
            e.stopPropagation(); // Stop click on track if thumb is clicked
            isDraggingThumb = true;
            dragStartX = e.clientX;
            // trackScrollLeftStart = carouselTrack.scrollLeft; // Not needed here, calculated dynamically
            sliderThumb.classList.add('dragging');
            stopAutoScroll();
            document.addEventListener('pointermove', handleThumbDrag);
            document.addEventListener('pointerup', stopThumbDrag);
        });

        const handleThumbDrag = (e) => {
            if (!isDraggingThumb) return;
            e.preventDefault();
            const dx = e.clientX - dragStartX;
            dragStartX = e.clientX; // Update for next move event

            const thumbTrackWidth = sliderTrack.clientWidth;
            const thumbWidth = sliderThumb.offsetWidth;
            const maxThumbLeft = thumbTrackWidth - thumbWidth;

            let newThumbLeft = parseFloat(sliderThumb.style.left || 0) + dx;
            newThumbLeft = Math.max(0, Math.min(newThumbLeft, maxThumbLeft));
            sliderThumb.style.left = `${newThumbLeft}px`;

            const scrollPercentage = newThumbLeft / maxThumbLeft;
            const scrollableTrackWidth = carouselTrack.scrollWidth - carouselTrack.clientWidth;
            carouselTrack.scrollLeft = scrollPercentage * scrollableTrackWidth;
            // No need to call updateSliderThumbVisuals here as we are directly setting thumb position
            // but if scrollLeft has constraints, it might be useful.
            // For safety and consistency after programmatic scrollLeft change:
             updateSliderThumbVisuals(); // This will also sync currentIndex if we update it based on scroll.
                                        // However, for thumb dragging, direct scroll is usually enough.
                                        // We will update currentIndex on drag end.
        };

        const stopThumbDrag = () => {
            if (!isDraggingThumb) return;
            isDraggingThumb = false;
            sliderThumb.classList.remove('dragging');
            document.removeEventListener('pointermove', handleThumbDrag);
            document.removeEventListener('pointerup', stopThumbDrag);
            currentIndex = determineCurrentIndexFromScroll(); // Update index based on final scroll
            // Snap to the determined item if desired, or just leave it free-scrolled
            // scrollToIndex(currentIndex, 'smooth', true); // Optional: snap to item
            startAutoScrollAfterInteraction();
        };

        // Clicking on slider track to move thumb
        sliderTrack.addEventListener('click', (e) => {
            if (e.target === sliderThumb) return; // Ignore clicks on the thumb itself

            const rect = sliderTrack.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const thumbWidth = sliderThumb.offsetWidth;
            const thumbTrackWidth = sliderTrack.clientWidth;
            const maxThumbLeft = thumbTrackWidth - thumbWidth;

            let targetThumbLeft = clickX - thumbWidth / 2;
            targetThumbLeft = Math.max(0, Math.min(targetThumbLeft, maxThumbLeft));

            const scrollPercentage = targetThumbLeft / maxThumbLeft;
            const scrollableTrackWidth = carouselTrack.scrollWidth - carouselTrack.clientWidth;
            const targetScrollLeft = scrollPercentage * scrollableTrackWidth;

            // Determine target index for smooth scroll
            carouselTrack.scrollLeft = targetScrollLeft; // Temporarily set to get the correct index
            const targetIndex = determineCurrentIndexFromScroll();
            scrollToIndex(targetIndex, 'smooth');

            stopAutoScroll();
            startAutoScrollAfterInteraction();
        });
    }

    // --- Card/Track Dragging ---
    if (carouselTrack) {
        carouselTrack.addEventListener('pointerdown', (e) => {
            // Allow clicks on interactive elements within cards (e.g., links, buttons)
            if (e.target.closest('a, button')) {
                return;
            }
            isPointerDownOnTrack = true;
            dragStartX = e.pageX - carouselTrack.offsetLeft;
            trackScrollLeftStart = carouselTrack.scrollLeft;
            dragStartTime = Date.now();
            carouselTrack.style.cursor = 'grabbing';
            carouselTrack.style.scrollBehavior = 'auto'; // Allow instant scroll during drag
            stopAutoScroll();
            e.preventDefault(); // Prevent text selection, image dragging etc.
        });

        carouselTrack.addEventListener('pointerleave', () => {
            if (isPointerDownOnTrack) {
                // Optional: consider this a drag end or wait for pointerup
                // For now, we handle drag end primarily on pointerup
                // isPointerDownOnTrack = false;
                // carouselTrack.style.cursor = 'grab';
                // snapToClosestItem();
                // startAutoScrollAfterInteraction();
            }
        });

        carouselTrack.addEventListener('pointerup', (e) => {
            if (!isPointerDownOnTrack) return;
            isPointerDownOnTrack = false;
            carouselTrack.style.cursor = 'grab';
            carouselTrack.style.scrollBehavior = 'smooth'; // Restore smooth behavior for programmatic scrolls

            const dragEndTime = Date.now();
            // If it was a very short interaction, might be a click, not a drag
            // You can add logic here if items themselves are clickable and differentiate
            if (dragEndTime - dragStartTime > CLICK_DRAG_THRESHOLD_MS) {
                 // It was a drag, snap to the nearest item
                snapToClosestItem();
            } else {
                // Potentially a click on the track/item, decide action or do nothing.
                // If items are links, the pointerdown check for 'a, button' handles it.
            }
            startAutoScrollAfterInteraction();
        });

        carouselTrack.addEventListener('pointermove', (e) => {
            if (!isPointerDownOnTrack) return;
            e.preventDefault();
            const x = e.pageX - carouselTrack.offsetLeft;
            const walk = (x - dragStartX) * 1.5; // '*1.5' to make dragging feel a bit faster
            carouselTrack.scrollLeft = trackScrollLeftStart - walk;
            updateSliderThumbVisuals(); // Keep thumb in sync during drag
        });

        const snapToClosestItem = () => {
            const closestIndex = determineCurrentIndexFromScroll();
            scrollToIndex(closestIndex, 'smooth', true); // true for isDragEnd
        };

        // Sync currentIndex and thumb when scrolling via other means (e.g., mouse wheel, scrollbar)
        let scrollEndTimer;
        carouselTrack.addEventListener('scroll', () => {
            if (!isPointerDownOnTrack && !isDraggingThumb && !isScrolling) { // Only if not actively dragging/animating
                updateSliderThumbVisuals();
                clearTimeout(scrollEndTimer);
                scrollEndTimer = setTimeout(() => {
                    currentIndex = determineCurrentIndexFromScroll();
                    // Optionally, snap after manual scrollbar scroll
                    // snapToClosestItem();
                }, 150); // Adjust timeout as needed
            }
        });
    }

    // Initial Setup
    setTimeout(() => {
        // Ensure items are cloned for infinite scroll if not already handled by backend:
        // This assumes your HTML is set up for infinite scrolling like:
        // [clones of last items] [original items] [clones of first items]
        // If originalItemCount is the true number of unique items, and `items.length`
        // is 3 * originalItemCount, this is good.
        // If `items` only contains original items, you need to clone them here.
        // For this example, I assume cloning is handled, and `originalItemCount`
        // is the count of unique items, and `itemCount` includes clones.
        // The `currentIndex` starts at `originalItemCount` which implies the first
        // actual item in a setup like: [..., N-1, N] [1, 2, ..., N] [1, 2, ...]
        //                               ^clones          ^originals     ^clones
        //                                                ^currentIndex starts here

        setupSliderThumb();
        if (items.length > 0) {
            // Initial scroll to the first "original" item without smooth animation
            scrollToIndex(currentIndex, 'auto');
        }
        startAutoScroll();

        // Add grab cursor styling
        if (carouselTrack) carouselTrack.style.cursor = 'grab';
    }, 100); // Timeout to ensure layout is calculated

    // Recalculate on resize
    window.addEventListener('resize', () => {
        setupSliderThumb();
        // Recenter current item without smooth scroll
        if (items.length > 0 && items[currentIndex]) {
             scrollToIndex(currentIndex, 'auto');
        }
    });
});