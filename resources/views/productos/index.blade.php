@extends('layouts.app')

@section('title', 'Productos')
@section('subtitle', 'Gestión de artículos')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
    <div class="flex items-center gap-4 bg-[#0a0a0c] border border-white/5 p-1 rounded-2xl">
        <button class="px-6 py-2.5 bg-violet-600 text-white rounded-xl font-bold shadow-lg shadow-violet-600/20 transition-all">Todos</button>
        <button class="px-6 py-2.5 text-slate-500 hover:text-slate-300 transition-all font-semibold">Disponibles</button>
        <button class="px-6 py-2.5 text-slate-500 hover:text-slate-300 transition-all font-semibold">Sin Stock</button>
    </div>
    
    <a href="{{ route('productos.create') }}" class="flex items-center gap-2 px-8 py-3.5 violet-gradient text-white rounded-2xl font-bold hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-violet-600/20">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
        </svg>
        Nuevo Producto
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($productos as $producto)
    <div class="glass-panel p-8 rounded-[2.5rem] hover:border-violet-500/30 transition-all duration-500 group relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-violet-600/5 blur-3xl group-hover:bg-violet-600/10 transition-colors"></div>
        
        <div class="flex justify-between items-start mb-6">
            <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform duration-500">
                📦
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="text-[10px] uppercase font-black text-violet-400 bg-violet-400/10 px-3 py-1.5 rounded-full tracking-widest border border-violet-400/10">
                    {{ $producto->categoria?->nombre ?? 'Sin Categ.' }}
                </span>
                <span class="text-[10px] font-mono text-slate-600 group-hover:text-slate-400 transition-colors">
                    {{ $producto->sku }}
                </span>
            </div>
        </div>
        
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-violet-400 transition-colors">{{ $producto->nombre }}</h3>
            <div class="flex items-baseline gap-1">
                <span class="text-3xl font-black text-white">Bs {{ number_format($producto->precio, 2) }}</span>
            </div>
        </div>

        <div class="flex items-center justify-between pb-8 border-b border-white/5">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full {{ $producto->stock > 5 ? 'bg-emerald-500' : ($producto->stock > 0 ? 'bg-amber-500' : 'bg-red-500') }} animate-pulse"></div>
                <span class="text-sm font-semibold {{ $producto->stock > 0 ? 'text-slate-300' : 'text-red-400' }}">
                    {{ $producto->stock }} <span class="text-slate-500 font-normal">unidades</span>
                </span>
            </div>
            
            @if($producto->disponible)
                <span class="text-[10px] font-bold text-emerald-400 flex items-center gap-1 bg-emerald-400/5 px-2 py-1 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                    ACTIVO
                </span>
            @endif
        </div>

        <div class="flex items-center gap-3 pt-6">
            <a href="{{ route('productos.show', $producto) }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-white/5 hover:bg-white/10 text-white rounded-xl font-bold transition-all">
                Ver más
            </a>
            <div class="flex gap-2">
                <a href="{{ route('productos.edit', $producto) }}" class="w-12 h-12 flex items-center justify-center bg-white/5 hover:bg-violet-600/20 hover:text-violet-400 text-slate-400 rounded-xl transition-all" title="Editar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </a>
                <button 
                    class="js-delete-btn w-12 h-12 flex items-center justify-center bg-white/5 hover:bg-red-600/20 hover:text-red-400 text-slate-400 rounded-xl transition-all" 
                    data-delete-url="{{ route('productos.destroy', $producto) }}"
                    title="Eliminar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($productos->isEmpty())
<div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="w-24 h-24 bg-white/5 rounded-3xl flex items-center justify-center text-4xl mb-6">🏜️</div>
    <h3 class="text-xl font-bold text-white mb-2">No hay productos registrados</h3>
    <p class="text-slate-500 max-w-xs mx-auto">Empezá a construir tu inventario agregando tu primer producto al sistema.</p>
</div>
@endif

@endsection