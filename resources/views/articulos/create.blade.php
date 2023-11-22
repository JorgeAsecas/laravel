<x-app-layout>
    <form method="POST" action="{{ route('articulos.store') }}">
        @csrf


        <!-- Nombre -->
        <div>
            <x-input-label for="denominacion" :value="'Nombre del articulo'" />
            <x-text-input id="denominacion" class="block mt-1 w-full" type="text" name="denominacion" :value="old('denominacion')" required autofocus autocomplete="denominacion" />
            <x-input-error :messages="$errors->get('denominacion')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="precio" :value="'Precio del articulo'" />
            <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" :value="old('precio')" required autofocus autocomplete="precio" />
            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="categoria_id" :value="'Categoria del articulo'" />
            <select id="categoria_id" class="'block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'" name="categoria_id" required>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">
                    {{$categoria->nombre}}

                </option>

                @endforeach

            </select>
            <x-input-error :messages="$errors->get('categoria_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('articulos.index') }}">
                <x-secondary-button class="ms-4">
                    Volver
                </x-primary-button>
            </a>
            <x-primary-button class="ms-4">
                Insertar
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
