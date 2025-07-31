    <?php

    use App\Http\Middleware\TwofactorMiddleware;
    use App\Http\Middleware\UserRoleMiddleware;
    use Illuminate\Foundation\Application;
    use Illuminate\Foundation\Configuration\Exceptions;
    use Illuminate\Foundation\Configuration\Middleware;

    use App\Schedule\EventScheduler;
    use Illuminate\Console\Scheduling\Schedule;
    use Illuminate\Foundation\Console\ScheduleList;

    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/../routes/web.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware) {
            $middleware->alias([
                'twofactor' => TwofactorMiddleware::class,
                'role' => UserRoleMiddleware::class
            ]);

            $middleware->web(append: [
                \Illuminate\Session\Middleware\StartSession::class,
                \App\Http\Middleware\SetLocale::class,
            ]);
            // $middleware->appendToGroup('twofactor', [
            //     TwofactorMiddleware::class,
            // ]); 
        })
        ->withExceptions(function (Exceptions $exceptions) {
            //
        })
        ->withSchedule(function (Schedule $schedule) {
            (new \App\Schedule\EventScheduler())($schedule);
        })->create();
