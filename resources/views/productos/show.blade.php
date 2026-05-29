@extends('layouts.app')

@section('title', 'Detalles del Producto')
@section('subtitle', 'Visualización completa de la ficha técnica')

@section('content')

<div class="max-w-5xl mx-auto">
    <div class="mb-10 flex items-center justify-between">
        <a href="{{ route('productos.index') }}" class="group flex items-center gap-2 text-slate-500 hover:text-white transition-colors">
            <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-violet-600/20 group-hover:text-violet-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <span class="font-bold">Volver al catálogo</span>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('productos.edit', $producto) }}" class="flex items-center gap-2 px-6 py-3 bg-white/5 hover:bg-white/10 text-white rounded-2xl font-bold transition-all border border-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Editar
            </a>
            <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-2xl font-bold transition-all border border-red-500/10">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            <div class="glass-panel rounded-[2.5rem] p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-violet-600/5 blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-8">
                        <div>
                            <span class="text-[10px] uppercase font-black text-violet-400 bg-violet-400/10 px-3 py-1.5 rounded-full tracking-[0.2em] mb-4 inline-block border border-violet-400/10">
                                {{ $producto->categoria->nombre ?? 'Sin Categoría' }}
                            </span>
                            <h1 class="text-4xl font-extrabold text-white tracking-tight leading-tight">{{ $producto->nombre }}</h1>
                        </div>
                        <div class="w-20 h-20 bg-white/5 rounded-3xl flex items-center justify-center text-4xl shadow-inner">
                            📦
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 pt-8 border-t border-white/5">
                        <div>
                            <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Código SKU</p>
                            <p class="text-white font-mono font-bold text-lg">{{ $producto->sku }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Precio de Venta</p>
                            <p class="text-white font-bold text-xl">Bs {{ number_format($producto->precio, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Estado</p>
                            @if($producto->disponible)
                                <span class="text-emerald-400 font-bold flex items-center gap-1 text-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Activo
                                </span>
                            @else
                                <span class="text-slate-500 font-bold flex items-center gap-1 text-sm">
                                    <span class="w-2 h-2 rounded-full bg-slate-500"></span> Inactivo
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="glass-panel rounded-[2.5rem] p-8 border-l-4 border-l-violet-600">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-4">Stock Actual</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-5xl font-black text-white">{{ $producto->stock }}</span>
                        <span class="text-slate-400 font-medium">unidades</span>
                    </div>
                    <div class="mt-6 w-full bg-white/5 h-2 rounded-full overflow-hidden">
                        <div class="h-full bg-violet-600 rounded-full shadow-lg shadow-violet-600/50" style="width: {{ min(($producto->stock / 100) * 100, 100) }}%"></div>
                    </div>
                </div>

                <div class="glass-panel rounded-[2.5rem] p-8 border-l-4 border-l-blue-600">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-4">Fecha de Registro</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-lg">{{ $producto->created_at->format('d M, Y') }}</p>
                            <p class="text-slate-500 text-xs">{{ $producto->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="glass-panel rounded-[2.5rem] p-8">
                <h3 class="text-white font-bold mb-6 flex items-center gap-2">
                    Información Adicional
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-white/5">
                        <span class="text-slate-500 text-sm">ID Interno</span>
                        <span class="text-white font-mono text-xs">#PRD-{{ $producto->id }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-white/5">
                        <span class="text-slate-500 text-sm">Valor total est.</span>
                        <span class="text-emerald-400 font-bold">Bs {{ number_format($producto->precio * $producto->stock, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-slate-500 text-sm">Visibilidad</span>
                        @if($producto->disponible)
                            <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 rounded-md text-[10px] font-bold">PÚBLICO</span>
                        @else
                            <span class="px-2 py-0.5 bg-slate-800 text-slate-500 rounded-md text-[10px] font-bold">OCULTO</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection