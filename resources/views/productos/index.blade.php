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

<div class="glass-panel rounded-[2.5rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-white/5 bg-white/5 uppercase text-[10px] font-black text-slate-500 tracking-widest">
                <th class="px-8 py-6">Producto</th>
                <th class="px-8 py-6">SKU</th>
                <th class="px-8 py-6">Categoría</th>
                <th class="px-8 py-6">Precio</th>
                <th class="px-8 py-6">Stock</th>
                <th class="px-8 py-6 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach($productos as $producto)
            <tr class="group hover:bg-white/[0.02] transition-colors">
                <td class="px-8 py-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-lg">📦</div>
                        <span class="text-white font-bold">{{ $producto->nombre }}</span>
                    </div>
                </td>
                <td class="px-8 py-6 text-slate-400 font-mono text-sm">{{ $producto->sku }}</td>
                <td class="px-8 py-6">
                    <span class="text-[10px] uppercase font-black text-violet-400 bg-violet-400/10 px-3 py-1 rounded-full border border-violet-400/10 tracking-widest">
                        {{ $producto->categoria?->nombre ?? 'Sin Categ.' }}
                    </span>
                </td>
                <td class="px-8 py-6 text-white font-bold">Bs {{ number_format($producto->precio, 2) }}</td>
                <td class="px-8 py-6">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full {{ $producto->stock > 5 ? 'bg-emerald-500' : ($producto->stock > 0 ? 'bg-amber-500' : 'bg-red-500') }}"></div>
                        <span class="text-sm font-semibold text-slate-300">{{ $producto->stock }}</span>
                    </div>
                </td>
                <td class="px-8 py-6">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('productos.show', $producto) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white rounded-xl transition-all" title="Ver detalles">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <a href="{{ route('productos.edit', $producto) }}" class="p-2.5 bg-white/5 hover:bg-violet-600/20 text-slate-400 hover:text-violet-400 rounded-xl transition-all" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2.5 bg-white/5 hover:bg-red-600/20 text-slate-400 hover:text-red-400 rounded-xl transition-all" title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($productos->isEmpty())
<div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="w-24 h-24 bg-white/5 rounded-3xl flex items-center justify-center text-4xl mb-6">🏜️</div>
    <h3 class="text-xl font-bold text-white mb-2">No hay productos registrados</h3>
    <p class="text-slate-500 max-w-xs mx-auto">Empezá a construir tu inventario agregando tu primer producto al sistema.</p>
</div>
@endif

@endsection