import { useForm, usePage } from '@inertiajs/react';

const SearchBar = () => {
    const { categorias, marcas, modelos } = usePage().props;

    const { data, setData } = useForm({
        tipo: '',
        marca: '',
        modelo: '',
        codigo_original: '',
        codigo_sr: '',
    });

    return (
        <div className="flex h-[195px] w-full items-center bg-[#F5F5F5]">
            <form
                /* onSubmit={handleSubmit} */
                className="mx-auto flex h-[123px] w-[1200px] flex-row items-center gap-6 max-sm:h-auto max-sm:w-full max-sm:flex-col max-sm:gap-2 max-sm:px-4 max-sm:py-4"
            >
                <div className="flex w-[25%] flex-col gap-4">
                    <h2 className="text-primary-orange border-b pb-1 text-[24px] font-bold">Por tipo de producto</h2>
                    <div className="flex flex-col gap-2">
                        <label htmlFor="tipo" className="text-[16px]">
                            Tipo de producto
                        </label>
                        <select
                            className="focus:outline-primary-orange rounded-sm bg-white p-2 outline-transparent transition duration-300 focus:outline"
                            name="tipo"
                            id="tipo"
                            value={data.tipo}
                            onChange={(e) => setData('tipo', e.target.value)}
                        >
                            <option value="">Elegir tipo</option>
                            {categorias?.map((categoria) => (
                                <option key={categoria.id} value={categoria.id}>
                                    {categoria.name}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>

                <div className="flex w-[75%] flex-col gap-4">
                    <h2 className="text-primary-orange border-b pb-1 text-[24px] font-bold">Por vehículo / Código</h2>
                    <div className="flex flex-row gap-6">
                        <div className="flex w-full flex-col gap-2">
                            <label htmlFor="marca" className="text-[16px]">
                                Marca
                            </label>
                            <select
                                className="focus:outline-primary-orange rounded-sm bg-white p-2 outline-transparent transition duration-300 focus:outline"
                                name="marca"
                                id="marca"
                                value={data.marca}
                                onChange={(e) => setData('marca', e.target.value)}
                            >
                                <option value="">Elegir marca</option>
                                {marcas?.map((marca) => (
                                    <option key={marca.id} value={marca.id}>
                                        {marca.name}
                                    </option>
                                ))}
                            </select>
                        </div>

                        <div className="flex w-full flex-col gap-2">
                            <label htmlFor="modelo" className="text-[16px]">
                                Modelo
                            </label>
                            <select
                                className="focus:outline-primary-orange rounded-sm bg-white p-2 outline-transparent transition duration-300 focus:outline"
                                name="modelo"
                                id="modelo"
                                value={data.modelo}
                                onChange={(e) => setData('modelo', e.target.value)}
                            >
                                <option value="">Elegir modelo</option>
                                {modelos
                                    ?.filter((mod) => mod?.marca_id == data.marca)
                                    ?.map((modelo) => (
                                        <option key={modelo.id} value={modelo.id}>
                                            {modelo.name}
                                        </option>
                                    ))}
                            </select>
                        </div>

                        <div className="flex w-full flex-col gap-2">
                            <label htmlFor="codigo_original" className="text-[16px]">
                                Código Original
                            </label>
                            <input
                                type="text"
                                className="focus:outline-primary-orange rounded-sm bg-white p-2 outline-transparent transition duration-300 focus:outline"
                                id="codigo_original"
                                name="codigo_original"
                                placeholder="Ingrese código original"
                                value={data.codigo_original}
                                onChange={(e) => setData('codigo_original', e.target.value)}
                            />
                        </div>

                        <div className="flex w-full flex-col gap-2">
                            <label htmlFor="codigo_sr" className="text-[16px]">
                                Código SR33
                            </label>
                            <input
                                type="text"
                                className="focus:outline-primary-orange rounded-sm bg-white p-2 outline-transparent transition duration-300 focus:outline"
                                id="codigo_sr"
                                name="codigo_sr"
                                placeholder="Ingrese código sr33"
                                value={data.codigo_sr}
                                onChange={(e) => setData('codigo_sr', e.target.value)}
                            />
                        </div>
                    </div>
                </div>

                <div className="flex h-full w-fit items-end">
                    <button
                        type="submit"
                        className="bg-primary-orange hover:bg-primary-orange-dark rounded-sm px-4 py-2 text-[16px] font-semibold text-white transition duration-300"
                    >
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    );
};

export default SearchBar;
