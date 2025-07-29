<?php

return [
    // --- Keys for Restaurant Home Page ---
    'home_page_title' => 'Restaurant Home Page',
    'total_orders_today_title' => 'Total Orders Today',
    'orders_suffix' => 'Orders', // e.g., "5 Orders"
    'todays_income_title' => 'Today\'s Income',
    'todays_most_purchased_title' => 'Today\'s Most Purchased',
    'order_list_heading' => 'ORDER LIST',
    'no_pending_orders' => 'You\'re all caught up! No pending orders!',
    'new_customer_ratings_heading' => 'NEW CUSTOMER RATINGS',
    'no_customer_ratings_yet' => 'No customer ratings yet.',
    'total_orders_this_week_heading' => 'TOTAL ORDERS THIS WEEK',
    'main_courses_category' => 'Main Courses',
    'desserts_category' => 'Desserts',
    'snacks_category' => 'Snacks',
    'drinks_category' => 'Drinks',
    'transaction_report_button' => 'Transaction Report',
    'unknown_customer' => 'Unknown', // For customer name if not found
    'other_category' => 'Other', // For food category if not found

    'customer_role' => 'Customer',
    'order_created_status_button' => 'Accept',
    'ready_to_pickup_status_button' => 'Accepted',
    'completed_status_button' => 'Completed',

    // --- New keys for Restaurant Manage Food Page ---
    'manage_food_title' => 'Restaurant Manage Food Page',
    'manage_food_heading' => 'LET\'S MANAGE YOUR FOOD!',
    'food_list_subtitle' => ':restaurant_name\'s food list', // :restaurant_name will be replaced by the actual name
    'search_food_placeholder' => 'Search food name...',
    'all_categories_filter' => 'All',
    'upload_csv_instruction_1' => 'You can also upload in a CSV format file! Click here',
    'upload_csv_import_button' => 'Import',
    'table_header_no' => 'No',
    'table_header_image' => 'Image',
    'table_header_food_name' => 'Food Name',
    'table_header_food_description' => 'Food Description',
    'table_header_expiration_time' => 'Expiration Time',
    'table_header_category' => 'Category',
    'table_header_stock' => 'Stock',
    'table_header_status' => 'Status',
    'add_food_button' => '+ Add Food',
    'no_image_text' => 'No Image',
    'edit_button' => 'Edit',
    'delete_button' => 'Delete',

    // Add Food Modal
    'add_food_modal_title' => 'Add Food',
    'add_food_name_label' => 'Food Name',
    'add_food_image_label' => 'Food Image',
    'add_category_label' => 'Category',
    'add_category_placeholder' => 'Choose category...',
    'add_food_description_label' => 'Food Description',
    'add_expiration_date_label' => 'Expiration Date',
    'add_expiration_time_label' => 'Expiration Time',
    'add_stock_label' => 'Stock',
    'add_status_available' => 'Available',
    'close_button' => 'Close',
    'submit_button' => 'Submit',

    // Edit Food Modal
    'edit_food_modal_title' => 'Edit Food',
    'edit_food_name_label' => 'Food Name',
    'edit_food_image_label' => 'New Food Image (Optional)',
    'edit_image_hint' => 'Leave blank if you don\'t want to change the image.',
    'edit_category_label' => 'Category',
    'edit_category_placeholder' => 'Choose category...',
    'edit_food_description_label' => 'Food Description',
    'edit_expiration_date_label' => 'Expiration Date',
    'edit_expiration_time_label' => 'Expiration Time',
    'edit_stock_label' => 'Stock',
    'edit_status_available' => 'Available',
    'save_changes_button' => 'Save Changes',

    // Delete Confirmation Modal
    'delete_confirm_modal_title' => 'Delete Confirmation',
    'delete_confirm_message' => 'Are you sure you want to delete this food item: :food_name?',
    'delete_undo_warning' => 'This action cannot be undone.',
    'cancel_button' => 'Cancel',
    'yes_delete_button' => 'Yes, Delete',

    // Upload CSV Modal
    'upload_csv_modal_title' => 'Upload CSV File',
    'csv_instruction_heading' => 'Instructions:',
    'csv_instruction_1' => '1. Download the provided CSV template.',
    'csv_instruction_2' => '2. Fill in your food data according to the example, then save the file.',
    'csv_instruction_3' => '3. Place the saved CSV file and all corresponding image files into a single folder.',
    'csv_instruction_4' => '4. Make sure the image file names in the folder exactly match the names in the `image_url` column of your CSV.',
    'csv_instruction_5' => '5. The `category_name` must be one of the following: <strong>Main Course, Dessert, Drinks, Snacks</strong>.',
    'csv_instruction_6' => '6. The `exp_datetime` must follow the format: <strong>YYYY-MM-DD HH:MM:SS</strong> (e.g., 2025-12-31 23:59:00).',
    'csv_instruction_7' => '7. Compress the entire folder into a single <strong>.zip</strong> file.',
    'csv_instruction_8' => '8. Upload the .zip file below.',
    'download_csv_template_button' => '📥 Download CSV Template',
    'choose_zip_file_label' => 'Choose .zip file',
    'upload_and_proceed_button' => 'Upload and Proceed',

    // --- New keys for Restaurant Orders Page ---
    'orders_page_title' => 'Orders Page',
    'manage_orders_heading' => 'LETS MANAGE YOUR ORDERS!',
    'table_header_no' => 'No', // Re-using if already defined, otherwise add
    'table_header_id' => 'ID', // Re-using if already defined, otherwise add
    'table_header_order_id' => 'Order ID',
    'table_header_customer_name' => 'Customer Name',
    'table_header_food_name' => 'Food Name',
    'table_header_qty' => 'Qty',
    'table_header_notes' => 'Notes',
    'table_header_order_date' => 'Order Date',
    'table_header_action' => 'Action',
    'order_created_button' => 'Accept',
    'ready_to_pickup_button' => 'Accepted',
    'order_completed_button' => 'Completed',

    // --- New keys for Restaurant Activity Page ---
    'activity_page_title' => 'Orders Page', // Re-using title for now, can be changed to 'Activity Page' if desired
    'activity_heading' => 'ACTIVITY',
    'all_ratings_filter' => 'All',
    'table_header_rating' => 'Rating',

    // --- New keys for Restaurant Transaction Report Page ---
    'transaction_report_title' => 'Sayfood | Restaurant Transaction Report',
    'transaction_report_heading' => 'TRANSACTION REPORT',
    'date_start_label' => 'Date Start',
    'date_end_label' => 'Date End',
    'filter_button' => 'Filter',
    'download_report_button' => 'Download Report',
    'table_header_price' => 'Price',
    'table_header_total_price' => 'Total Price',
    'currency_prefix' => 'Rp',
    'currency_suffix' => ',00',

    // --- New keys for Report Restaurant Modal ---
    'report_restaurant_modal_title' => 'Report Restaurant',
    'report_restaurant_question' => 'Why do you want to report this restaurant?',
    'reason_expired_foods' => 'They sell expired foods',
    'reason_others_label' => 'Others:',
    'reason_others_placeholder' => 'Write something...',
    'submit_report_button' => 'Submit',
    'report_success_message' => 'Report submitted successfully!',
];