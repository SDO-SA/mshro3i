<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>مشروعي</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=alexandria:400,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="antialiased light">
        <div class="bg-white h-screen">
            <div class="relative isolate px-6 pt-28 pt mt sm:pt-1 lg:px-8">
                <div class="absolute inset-x-0 -top-8 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#8fff80] to-[#89effc] opacity-50 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
                <div class="flex justify-center">
                    <div class="grid lg:grid-cols-2 sm:grid-cols-1 size-fit">
                        <div class="flex flex-col justify-center">
                            <div class="flex justify-end mb-5"> 
                                <x-application-logo class="h-32"/>
                            </div>
                            <div class="text-right">
                                <h1 class="text-4xl sm:text-7xl font-bold tracking-tight text-gray-900">
                                    منصتنا ليست فقط 
                                    <br>
                                    <span class="inline-grid text-7xl sm:text-9xl">
                                        <span class="pointer-events-none col-start-1 row-start-1 bg-[linear-gradient(90deg,theme(colors.error)_0%,theme(colors.secondary)_9%,theme(colors.secondary)_42%,theme(colors.primary)_47%,theme(colors.accent)_100%)] bg-clip-text blur-xl [-webkit-text-fill-color:transparent] [transform:translate3d(0,0,0)] before:content-[attr(data-text)] [@supports(color:oklch(0%_0_0))]:bg-[linear-gradient(90deg,oklch(var(--s))_4%,color-mix(in_oklch,oklch(var(--s)),oklch(var(--er)))_22%,oklch(var(--p))_45%,color-mix(in_oklch,oklch(var(--p)),oklch(var(--a)))_67%,oklch(var(--a))_100.2%)]" aria-hidden="true" data-text="منصة">
                                        </span> 
                                        <span class="[&amp;::selection]:text-base-content relative col-start-1 row-start-1 bg-[linear-gradient(90deg,theme(colors.error)_0%,theme(colors.secondary)_9%,theme(colors.secondary)_42%,theme(colors.primary)_47%,theme(colors.accent)_100%)] bg-clip-text [-webkit-text-fill-color:transparent] [&amp;::selection]:bg-blue-700/20 [@supports(color:oklch(0%_0_0))]:bg-[linear-gradient(90deg,oklch(var(--s))_4%,color-mix(in_oklch,oklch(var(--s)),oklch(var(--er)))_22%,oklch(var(--p))_45%,color-mix(in_oklch,oklch(var(--p)),oklch(var(--a)))_67%,oklch(var(--a))_100.2%)]">
                                            <img loading="lazy" width="72" height="72" class="transition-all duration-300 ease-in-out group-hover:scale-110 pointer-events-none inline-block h-[1em] w-[1em] align-bottom" src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/People/Man%20Student.png" alt="Man Student">
                                            منصة
                                        </span>
                                    </span>
                                </h1>
                                <p class="mt-6 text-2xl sm:text-3xl leading-8 text-gray-600">
                                    <img loading="lazy" width="72" height="72" alt="sunglasses emoji" src="https://img.daisyui.com/images/emoji/smiling-face-with-sunglasses@80.webp" srcset="https://img.daisyui.com/images/emoji/smiling-face-with-sunglasses.webp 2x" class="pointer-events-none inline-block h-[1em] w-[1em] align-bottom">
                                    تنظيم وادارة مشروع تخرجك صار ولا أسهل باستخدام منصتنا
                                </p>
                                    <div class="mt-10 flex items-center justify-end gap-x-6">
                                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">سجل دخول</a>
                                        <a href="{{ route('register') }}" class="rounded-md bg-royalblue-100 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-royalblue-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-royalblue-100">سجل معانا <span aria-hidden="true">→</span></a>
                                    </div>
                            </div>
                        </div>
                        <div class="">
                            <img src="{{ asset('img/college-project.svg') }}" alt="" class="hidden lg:w-[1280px] lg:h-[1000px] sm:w-auto sm:block sm:h-auto">
                        </div>   
                    </div>
                </div>
                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-40rem)]" aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#89effc] to-[#fc89fa] opacity-50 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
            </div>
        </div>
    </body>
</html>
