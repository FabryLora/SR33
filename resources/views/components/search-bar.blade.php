<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('filtroMarcas', () => ({
            // Estado inicial desde la URL
            categoriaSeleccionada: '{{ request("tipo") }}' || '',
            marcaSeleccionada: '{{ request("marca") }}' || '',
            modeloSeleccionado: '{{ request("modelo") }}' || '',

            categorias: @js($categorias),

            marcas: @js($marcas),
            // 👇 Asegurate de pasar $modelos como array con {id, name, marca_id}
            modelos: @js($modelos),

            init() {
                // Si cambia la categoría: vaciar marca y modelo
                this.$watch('categoriaSeleccionada', () => {
                    this.marcaSeleccionada = '';
                    this.modeloSeleccionado = '';
                });
                // Si cambia la marca: vaciar modelo
                this.$watch('marcaSeleccionada', () => {
                    this.modeloSeleccionado = '';
                });
            },

            get marcasFiltradas() {
                if (!this.categoriaSeleccionada) return this.marcas;
                return this.categorias.find((car) => car.id == this.categoriaSeleccionada)?.marcas || [];
            },

            // 🔹 Modelos filtrados por marca seleccionada
            get modelosFiltrados() {
                if (!this.marcaSeleccionada) return [];
                return this.marcas.find(marca => marca.id == this.marcaSeleccionada)?.modelos || [];
            },
        }));
    });
</script>




<!-- 🔹 Envolver el formulario (o al menos los selects) con x-data -->
<div x-data="filtroMarcas"
    class="w-full h-auto min-h-[195px] max-lg:min-h-0 bg-[#F5F5F5] flex items-center py-6 max-lg:py-4">
    <form action="{{ route('productos') }}" method="GET"
        class="flex flex-col lg:flex-row gap-6 max-sm:gap-4 w-[1200px] max-xl:w-full max-xl:px-6 max-lg:px-4 max-sm:px-4 mx-auto h-auto lg:h-[123px] items-start lg:items-center">

        <!-- Sección: Por tipo de producto -->
        <div class="flex flex-col w-full lg:w-[25%] gap-4 max-sm:gap-3">
            <h2 class="text-[24px] max-md:text-[20px] max-sm:text-[18px] font-bold text-primary-orange border-b pb-1">
                Por tipo de producto
            </h2>
            <div class="flex flex-col gap-2 relative">
                <label for="tipo" class="text-[16px] max-sm:text-[14px] font-medium">Tipo de producto</label>
                <div class="relative">
                    <!-- 🔹 x-model correcto y name="tipo" (coincide con backend) -->
                    <select
                        class="rounded-sm bg-white p-2 pr-10 outline-transparent focus:outline focus:outline-primary-orange transition duration-300 w-full text-sm max-sm:text-xs"
                        name="tipo" x-model="categoriaSeleccionada" id="tipo">
                        <option value="">Elegir el tipo de producto</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($tipo ?? '')
                        <a href="{{ route('productos', array_filter(request()->except('tipo'))) }}"
                            class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition duration-200"
                            title="Eliminar filtro">
                            <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sección: Por vehículo / Código -->
        <div class="flex flex-col w-full lg:w-[75%] gap-4 max-sm:gap-3">
            <h2 class="text-[24px] max-md:text-[20px] max-sm:text-[18px] font-bold text-primary-orange border-b pb-1">
                Por vehículo / Código
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 max-sm:gap-3">
                <!-- Marca -->
                <div class="flex flex-col gap-2 w-full">
                    <label for="marca" class="text-[16px] max-sm:text-[14px] font-medium">Marca</label>
                    <div class="relative">
                        <!-- 🔹 Enlazar a x-model para que se resetee al cambiar categoría -->
                        <select
                            class="rounded-sm bg-white p-2 pr-10 outline-transparent focus:outline focus:outline-primary-orange transition duration-300 w-full text-sm max-sm:text-xs"
                            name="marca" id="marca" x-model="marcaSeleccionada"
                            :disabled="marcasFiltradas.length === 0">
                            <option value="">Elegir marca</option>
                            <template x-for="marca in marcasFiltradas" :key="marca.id">
                                <option :value="marca.id" x-text="marca.name"></option>
                            </template>
                        </select>
                        @if($marca ?? '')
                            <a href="{{ route('productos', array_filter(request()->except('marca'))) }}"
                                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition duration-200"
                                title="Eliminar filtro">
                                <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Modelo (igual que lo tenías) -->
                <!-- Modelo -->
                <div class="flex flex-col gap-2 w-full">
                    <label for="modelo" class="text-[16px] max-sm:text-[14px] font-medium">Modelo</label>
                    <div class="relative">
                        <select
                            class="rounded-sm bg-white p-2 pr-10 outline-transparent focus:outline focus:outline-primary-orange transition duration-300 w-full text-sm max-sm:text-xs"
                            name="modelo" id="modelo" x-model="modeloSeleccionado"
                            :disabled="modelosFiltrados.length === 0">
                            <option value="">Elegir modelo</option>
                            <template x-for="modeloItem in modelosFiltrados" :key="modeloItem.id">
                                <option :value="modeloItem.id" x-text="modeloItem.name"></option>
                            </template>
                        </select>

                        @if($modelo ?? '')
                            <a href="{{ route('productos', array_filter(request()->except('modelo'))) }}"
                                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition duration-200"
                                title="Eliminar filtro">
                                <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>


                <!-- Código Original -->
                <div class="flex flex-col gap-2 w-full">
                    <label for="codigo_original" class="text-[16px] max-sm:text-[14px] font-medium">Código
                        Original</label>
                    <div class="relative">
                        <input value="{{ $code ?? '' }}" type="text"
                            class="rounded-sm bg-white p-2 pr-10 outline-transparent focus:outline focus:outline-primary-orange transition duration-300 w-full text-sm max-sm:text-xs"
                            id="codigo_original" name="code" placeholder="Ingrese código original">
                        @if($code ?? '')
                            <a href="{{ route('productos', array_filter(request()->except('code'))) }}"
                                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition duration-200"
                                title="Eliminar filtro">
                                <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Código SR33 -->
                <div class="flex flex-col gap-2 w-full">
                    <label for="codigo_sr" class="text-[16px] max-sm:text-[14px] font-medium">Código SR33</label>
                    <div class="relative">
                        <input value="{{ $codesr ?? '' }}" type="text"
                            class="rounded-sm bg-white p-2 pr-10 outline-transparent focus:outline focus:outline-primary-orange transition duration-300 w-full text-sm max-sm:text-xs"
                            id="codigo_sr" name="code_sr" placeholder="Ingrese código sr33">
                        @if($codesr ?? '')
                            <a href="{{ route('productos', array_filter(request()->except('code_sr'))) }}"
                                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition duration-200"
                                title="Eliminar filtro">
                                <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de búsqueda -->
        <div class="flex flex-col items-center h-full lg:items-end justify-end w-full lg:w-fit gap-2 mt-4 lg:mt-0">
            <button type="submit"
                class="bg-primary-orange text-white rounded-sm px-6 py-2 max-sm:px-4 max-sm:py-1.5 text-[16px] max-sm:text-[14px] font-semibold hover:bg-primary-orange-dark transition duration-300 w-full lg:w-auto min-w-[120px] max-sm:min-w-[100px]">
                Buscar
            </button>
        </div>
    </form>
</div>