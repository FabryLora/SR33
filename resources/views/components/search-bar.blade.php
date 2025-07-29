<div class="w-full h-[195px] bg-[#F5F5F5] flex items-center">
    <form action="{{ route('productos') }}" method="GET"
        class="flex flex-row max-sm:flex-col gap-6 max-sm:gap-2 w-[1200px] max-sm:w-full max-sm:px-4 mx-auto h-[123px] max-sm:h-auto max-sm:py-4 items-center">

        <div class="flex flex-col w-[25%] gap-4">
            <h2 class="text-[24px] font-bold text-primary-orange border-b pb-1">Por tipo de producto</h2>
            <div class="flex flex-col gap-2">
                <label for="tipo" class="text-[16px]">Tipo de producto</label>
                <select class="rounded-sm bg-white p-2" name="" id="tipo">
                    <option value="">Elegir tipo</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-col w-[75%] gap-4">
            <h2 class="text-[24px] font-bold text-primary-orange border-b pb-1">Por vehículo / Código</h2>
            <div class="flex flex-row gap-6">
                <div class="flex flex-col gap-2 w-full">
                    <label for="marca" class="text-[16px]">Marca</label>
                    <select class="rounded-sm bg-white p-2" name="" id="marca">
                        <option value="">Elegir marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <label for="modelo" class="text-[16px]">Modelo</label>
                    <select class="rounded-sm bg-white p-2" name="" id="modelo">
                        <option value="">Elegir modelo</option>
                        @foreach ($modelos as $modelo)
                            <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>

                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <label for="codigo_original" class="text-[16px]">Código Original</label>
                    <input type="text" class="rounded-sm bg-white p-2" id="codigo_original" name="codigo_original"
                        placeholder="Ingrese código original">
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <label for="codigo_sr" class="text-[16px]">Código SR33</label>
                    <input type="text" class="rounded-sm bg-white p-2" id="codigo_sr" name="codigo_sr"
                        placeholder="Ingrese código sr33">
                </div>
            </div>

        </div>

        <div class="h-full flex items-end w-fit">
            <button type="submit"
                class="bg-primary-orange text-white rounded-sm px-4 py-2 text-[16px] font-semibold hover:bg-primary-orange-dark transition duration-300">
                Buscar
            </button>
        </div>

    </form>
</div>