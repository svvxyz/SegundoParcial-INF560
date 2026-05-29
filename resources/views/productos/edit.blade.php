@extends('layouts.app')

@section('title', 'Edición')
@section('subtitle', 'Modificar datos del artículo')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="mb-10 flex items-center justify-between">
        <a href="{{ route('productos.index') }}" class="group flex items-center gap-2 text-slate-500 hover:text-white transition-colors">
            <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-violet-600/20 group-hover:text-violet-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <span class="font-bold">Volver al catálogo</span>
        </a>
    </div>

    <div class="glass-panel rounded-[2.5rem] p-10 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-violet-600/5 blur-3xl pointer-events-none"></div>

        <form action="{{ route('productos.update', $producto) }}" method="POST" class="space-y-10 relative z-10">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Nombre del producto</label>
                    <div class="relative group">
                        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" 
                            class="w-full bg-[#050505] border border-white/5 rounded-2xl px-5 py-4 text-white placeholder:text-slate-700 focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500 transition-all outline-none group-hover:border-white/10"
                            placeholder="Ej. Teclado Mecánico RGB">
                        @error('nombre') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Código SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $producto->sku) }}" 
                        class="w-full bg-[#050505] border border-white/5 rounded-2xl px-5 py-4 text-white font-mono placeholder:text-slate-700 focus:ring-2 focus:ring-violet-500/50 transition-all outline-none"
                        placeholder="SKU-000">
                    @error('sku') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Categoría</label>
                    <div class="relative">
                        <select name="categoria_id" class="w-full bg-[#050505] border border-white/5 rounded-2xl px-5 py-4 text-white appearance-none focus:ring-2 focus:ring-violet-500/50 transition-all outline-none">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('categoria_id') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Precio Unitario (Bs)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 font-bold">Bs</span>
                        <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" 
                            class="w-full bg-[#050505] border border-white/5 rounded-2xl pl-12 pr-5 py-4 text-white placeholder:text-slate-700 focus:ring-2 focus:ring-violet-500/50 transition-all outline-none"
                            placeholder="0.00">
                    </div>
                    @error('precio') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Stock Actual</label>
                    <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" 
                        class="w-full bg-[#050505] border border-white/5 rounded-2xl px-5 py-4 text-white placeholder:text-slate-700 focus:ring-2 focus:ring-violet-500/50 transition-all outline-none"
                        placeholder="0">
                    @error('stock') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 p-6 bg-white/5 rounded-3xl border border-white/5">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="disponible" value="1" {{ old('disponible', $producto->disponible) ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-14 h-7 bg-slate-800 rounded-full peer peer-checked:after:translate-x-[28px] peer-checked:bg-violet-600 after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-[20px] after:w-[20px] after:transition-all after:shadow-lg"></div>
                </label>
                <div>
                    <span class="block text-sm font-bold text-white">Disponible para la venta</span>
                    <span class="text-xs text-slate-500">¿El producto estará visible inmediatamente?</span>
                </div>
            </div>

            <div class="flex items-center gap-6 pt-10 border-t border-white/5">
                <button type="submit" class="flex-1 md:flex-none px-12 py-4 violet-gradient text-white rounded-2xl font-bold hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-violet-600/30">
                    Guardar Cambios
                </button>
                <a href="{{ route('productos.index') }}" class="px-8 py-4 text-slate-500 hover:text-white font-bold transition-colors">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</div>

@endsection