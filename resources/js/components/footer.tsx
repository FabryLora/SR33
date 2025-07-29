import { usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';

export default function Footer() {
    const { contacto, logos } = usePage().props;
    const [isMobile, setIsMobile] = useState(false);
    const [isTablet, setIsTablet] = useState(false);

    useEffect(() => {
        const handleResize = () => {
            setIsMobile(window.innerWidth < 640);
            setIsTablet(window.innerWidth >= 640 && window.innerWidth < 1024);
        };

        // Inicializar
        handleResize();

        // Agregar listener
        window.addEventListener('resize', handleResize);

        // Limpiar
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    return (
        <div className="flex h-fit w-full flex-col bg-[#4D565D]">
            <div className="mx-auto flex h-full w-full max-w-[1200px] flex-col items-center justify-between gap-10 px-4 py-10 lg:flex-row lg:items-start lg:gap-10 lg:px-0 lg:py-26">
                <div className="flex h-full flex-col items-center gap-4">
                    <a href="/">
                        <img src={logos?.logo_principal} alt="Logo secundario" className="max-w-[200px] sm:max-w-full" />
                    </a>

                    <div className="flex flex-row items-center justify-center gap-4 sm:gap-2">
                        {contacto?.fb && (
                            <a target="_blank" rel="noopener noreferrer" href={contacto?.fb} aria-label="Facebook">
                                <i className="fab fa-facebook-f text-lg text-[#E0E0E0]"></i>
                            </a>
                        )}

                        {contacto?.wp && (
                            <a target="_blank" rel="noopener noreferrer" href={contacto?.wp} aria-label="Instagram">
                                <i className="fab fa-instagram text-lg text-[#E0E0E0]"></i>
                            </a>
                        )}
                    </div>
                </div>

                <div className="hidden flex-col gap-10 lg:flex">
                    <h2 className="text-lg font-bold text-white">Secciones</h2>
                    <div className="grid h-fit grid-flow-col grid-cols-2 grid-rows-3 gap-x-20 gap-y-3">
                        <a href={'/empresa'} className="text-[15px] text-white/80">
                            Empresa
                        </a>
                        <a href="/productos" className="text-[15px] text-white/80">
                            Productos
                        </a>
                        <a href="/calidad" className="text-[15px] text-white/80">
                            Calidad
                        </a>
                        <a href="/lanzamientos" className="text-[15px] text-white/80">
                            Lanzamientos
                        </a>
                        <a href="/contacto" className="text-[15px] text-white/80">
                            Contacto
                        </a>
                    </div>
                </div>

                {/* <div className="flex flex-col items-center gap-6 sm:hidden">
            <h2 className="text-lg font-bold text-white">Secciones</h2>
            <div className="flex flex-wrap justify-center gap-x-6 gap-y-4">
                <a href="{{ route('nosotros') }}" className="text-[15px] text-white/80">Nosotros</a>
                <a href="{{ route('productos') }}" className="text-[15px] text-white/80">Productos</a>
                <a href="{{ route('calidad') }}" className="text-[15px] text-white/80">Calidad</a>
                <a href="{{ route('novedades') }}" className="text-[15px] text-white/80">Novedades</a>
                <a href="{{ route('contacto') }}" className="text-[15px] text-white/80">Contacto</a>
            </div>
        </div> */}

                <div className="flex h-full flex-col items-center gap-6 lg:items-start lg:gap-10">
                    <h2 className="text-lg font-bold text-white">Suscribite al Newsletter</h2>
                    <form
                        method="POST"
                        className="flex h-[44px] w-full items-center justify-between border border-[#E0E0E0] bg-white px-4 sm:w-[287px]"
                    >
                        <input name="email" type="email" required className="w-full outline-none" placeholder="Ingresa tu email" />
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M1 8H15M15 8L8 1M15 8L8 15"
                                    stroke="#0072C6"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </form>
                </div>

                <div className="flex h-full flex-col items-center gap-6 lg:items-start lg:gap-10">
                    <h2 className="text-lg font-bold text-white">Datos de contacto</h2>
                    <div className="flex flex-col justify-center gap-4">
                        {contacto?.location && (
                            <a
                                href="https://maps.google.com/?q={{ urlencode($contacto->location) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="flex items-center gap-3 transition-opacity hover:opacity-80"
                            >
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                                        <path
                                            d="M8 0C5.87904 0.00245748 3.84566 0.831051 2.34592 2.30402C0.846168 3.77699 0.00251067 5.77405 8.51118e-06 7.85714C-0.00253177 9.55945 0.56363 11.2156 1.61164 12.5714C1.61164 12.5714 1.82982 12.8536 1.86546 12.8943L8 20L14.1374 12.8907C14.1694 12.8529 14.3884 12.5714 14.3884 12.5714L14.3891 12.5693C15.4366 11.214 16.0025 9.55866 16 7.85714C15.9975 5.77405 15.1538 3.77699 13.6541 2.30402C12.1543 0.831051 10.121 0.00245748 8 0ZM8 10.7143C7.42464 10.7143 6.86219 10.5467 6.3838 10.2328C5.9054 9.91882 5.53254 9.4726 5.31235 8.95052C5.09217 8.42845 5.03456 7.85397 5.14681 7.29974C5.25906 6.74551 5.53612 6.23642 5.94296 5.83684C6.34981 5.43726 6.86816 5.16514 7.43247 5.0549C7.99677 4.94466 8.58169 5.00124 9.11326 5.21749C9.64483 5.43374 10.0992 5.79994 10.4188 6.2698C10.7385 6.73965 10.9091 7.29205 10.9091 7.85714C10.9081 8.61461 10.6013 9.34079 10.056 9.8764C9.51062 10.412 8.77124 10.7133 8 10.7143Z"
                                            fill="white"
                                        />
                                    </svg>
                                </div>

                                <p className="max-w-[326px] text-base break-words text-white/80">{contacto?.location}</p>
                            </a>
                        )}

                        {contacto?.mail && (
                            <a href="mailto:{{ $contacto->mail }}" className="flex items-center gap-3 transition-opacity hover:opacity-80">
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                        <path
                                            d="M16.2 0H1.8C0.81 0 0.00899999 0.7875 0.00899999 1.75L0 12.25C0 13.2125 0.81 14 1.8 14H16.2C17.19 14 18 13.2125 18 12.25V1.75C18 0.7875 17.19 0 16.2 0ZM15.84 3.71875L9.477 7.58625C9.189 7.76125 8.811 7.76125 8.523 7.58625L2.16 3.71875C2.06975 3.6695 1.99073 3.60295 1.9277 3.52315C1.86467 3.44334 1.81896 3.35193 1.79332 3.25445C1.76768 3.15697 1.76265 3.05544 1.77854 2.95602C1.79443 2.85659 1.8309 2.76134 1.88575 2.67601C1.9406 2.59069 2.01269 2.51707 2.09765 2.45962C2.18262 2.40217 2.27868 2.36207 2.38005 2.34176C2.48141 2.32145 2.58595 2.32135 2.68736 2.34145C2.78876 2.36156 2.88492 2.40147 2.97 2.45875L9 6.125L15.03 2.45875C15.1151 2.40147 15.2112 2.36156 15.3126 2.34145C15.414 2.32135 15.5186 2.32145 15.62 2.34176C15.7213 2.36207 15.8174 2.40217 15.9023 2.45962C15.9873 2.51707 16.0594 2.59069 16.1142 2.67601C16.1691 2.76134 16.2056 2.85659 16.2215 2.95602C16.2373 3.05544 16.2323 3.15697 16.2067 3.25445C16.181 3.35193 16.1353 3.44334 16.0723 3.52315C16.0093 3.60295 15.9302 3.6695 15.84 3.71875Z"
                                            fill="white"
                                        />
                                    </svg>
                                </div>
                                <p className="text-base break-words text-white/80">{contacto?.mail}</p>
                            </a>
                        )}

                        {contacto?.phone && (
                            <a
                                href="tel:{{ preg_replace('/\s/', '', $contacto->phone) }}"
                                className="flex items-center gap-3 transition-opacity hover:opacity-80"
                            >
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M3.37587 6.9248C4.62166 9.44461 6.60335 11.4944 9.0395 12.7829L10.9301 10.8274C11.0424 10.711 11.1839 10.6294 11.3387 10.5917C11.4934 10.554 11.6553 10.5617 11.806 10.614C12.796 10.9504 13.8316 11.1213 14.8736 11.1204C15.1013 11.1211 15.3195 11.215 15.4805 11.3815C15.6415 11.5481 15.7323 11.7737 15.733 12.0092V15.1111C15.7323 15.3466 15.6415 15.5723 15.4805 15.7388C15.3195 15.9054 15.1013 15.9993 14.8736 16C12.9552 16 11.0555 15.6091 9.28307 14.8497C7.51065 14.0903 5.90022 12.9772 4.54372 11.574C3.18723 10.1708 2.11124 8.50491 1.3772 6.67155C0.643158 4.8382 0.265444 2.87324 0.265625 0.888889C0.26635 0.653372 0.357124 0.427715 0.518131 0.261178C0.679139 0.0946416 0.897303 0.000750061 1.125 0H4.1335C4.3612 0.000750061 4.57936 0.0946416 4.74037 0.261178C4.90138 0.427715 4.99215 0.653372 4.99288 0.888889C4.99127 1.96679 5.15652 3.03801 5.48238 4.06187C5.53123 4.21884 5.53705 4.38675 5.49918 4.54693C5.46131 4.70712 5.38125 4.8533 5.26788 4.96924L3.37587 6.9248Z"
                                            fill="white"
                                        />
                                    </svg>
                                </div>

                                <p className="text-base break-words text-white/80">{contacto?.phone}</p>
                            </a>
                        )}
                    </div>
                </div>
            </div>

            <div className="flex min-h-[67px] w-full flex-col items-center justify-center bg-[#4D565D] px-4 py-4 text-[14px] text-white/80 sm:flex-row sm:justify-between sm:px-6 lg:px-0">
                <div className="mx-auto flex w-full max-w-[1200px] flex-col items-center justify-center gap-2 text-center sm:flex-row sm:justify-between sm:gap-0 sm:text-left">
                    <p>© Copyright Autopartes TB. Todos los derechos reservados</p>
                    <a target="_blank" rel="noopener noreferrer" href="https://osole.com.ar/" className="mt-2 sm:mt-0">
                        By <span className="font-bold">Osole</span>
                    </a>
                </div>
            </div>
        </div>
    );
}
