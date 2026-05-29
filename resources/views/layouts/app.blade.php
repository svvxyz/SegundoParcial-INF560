<!DOCTYPE html>
<html lang="es" class="h-full bg-[#050505]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Catálogo') | catalogoApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #050505;
            color: #e2e8f0;
        }
        .glass-panel {
            background: rgba(15, 15, 20, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .violet-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%);
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #050505;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e1e2e;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #2d2d44;
        }
    </style>
</head>

<body class="h-full flex flex-col overflow-hidden">

    <div class="fixed top-[-10%] right-[-10%] w-[500px] h-[500px] bg-violet-600/10 blur-[120px] rounded-full pointer-events-none z-0"></div>
    <div class="fixed bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-blue-600/5 blur-[100px] rounded-full pointer-events-none z-0"></div>

    <header class="h-24 flex items-center justify-between px-12 z-20 border-b border-white/5 bg-[#050505]/50 backdrop-blur-md">
        <div class="flex items-center gap-4 group cursor-pointer" onclick="window.location='{{ route('productos.index') }}'">
            <div class="w-10 h-10 rounded-xl violet-gradient flex items-center justify-center shadow-lg shadow-violet-600/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">catalogo<span class="text-violet-500">App</span></span>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto z-10">
        <div class="max-w-6xl mx-auto px-8 py-12">
            
            <div class="mb-12">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">@yield('title')</h1>
                <p class="text-slate-500 mt-2 font-medium">@yield('subtitle')</p>
            </div>

            @yield('content')
        </div>

        <footer class="mt-auto py-12 text-center border-t border-white/5">
            <p class="text-slate-600 text-sm font-medium">© {{ date('Y') }} catalogoApp</p>
        </footer>
    </main>

</body>
</html>