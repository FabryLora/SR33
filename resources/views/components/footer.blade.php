{{-- resources/views/components/footer.blade.php --}}
<div class="flex h-fit w-full flex-col bg-black">
    <div
        class="mx-auto flex h-full w-full max-w-[1200px] flex-col items-center justify-between gap-20 px-4 py-10 lg:flex-row lg:items-start  lg:px-0 lg:py-26">
        {{-- Logo y redes sociales --}}
        <div class="flex h-full flex-col items-center gap-4">
            <a href="/">
                <img src="{{ $logos->logo_principal ?? '' }}" alt="Logo secundario"
                    class="max-w-[124px] max-h-[84px] sm:max-w-full" />
            </a>

            <div class="flex flex-row items-center justify-center gap-4 sm:gap-2">

                @if(!empty($contacto->ig))
                    <a target="_blank" rel="noopener noreferrer" href="{{ $contacto->ig }}" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M17.5 6.5H17.51M7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7C2 4.23858 4.23858 2 7 2ZM16 11.37C16.1234 12.2022 15.9813 13.0522 15.5938 13.799C15.2063 14.5458 14.5931 15.1514 13.8416 15.5297C13.0901 15.9079 12.2384 16.0396 11.4078 15.9059C10.5771 15.7723 9.80976 15.3801 9.21484 14.7852C8.61992 14.1902 8.22773 13.4229 8.09407 12.5922C7.9604 11.7616 8.09207 10.9099 8.47033 10.1584C8.84859 9.40685 9.45419 8.79374 10.201 8.40624C10.9478 8.01874 11.7978 7.87659 12.63 8C13.4789 8.12588 14.2649 8.52146 14.8717 9.12831C15.4785 9.73515 15.8741 10.5211 16 11.37Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif
                @if(!empty($contacto->fb))
                    <a target="_blank" rel="noopener noreferrer" href="{{ $contacto->fb }}" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M18 2H15C13.6739 2 12.4021 2.52678 11.4645 3.46447C10.5268 4.40215 10 5.67392 10 7V10H7V14H10V22H14V14H17L18 10H14V7C14 6.73478 14.1054 6.48043 14.2929 6.29289C14.4804 6.10536 14.7348 6 15 6H18V2Z"
                                fill="white" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        {{-- Secciones - Desktop/Tablet --}}
        <div class="hidden flex-col  gap-10 lg:flex">
            <h2 class="text-lg font-bold text-white">Secciones</h2>
            <div class="grid h-fit grid-flow-col grid-cols-2 grid-rows-2 gap-x-20 gap-y-3">
                <a {{-- href="{{ route('nosotros') }}" --}} class="text-[15px] text-white/80">Nosotros</a>
                <a href="{{ route('productos') }}" class="text-[15px] text-white/80">Productos</a>
                <a href="{{ route('calidad') }}" class="text-[15px] text-white/80">Novedades</a>
                <a href="{{ route('contacto') }}" class="text-[15px] text-white/80">Contacto</a>
            </div>
        </div>

        {{-- Secciones - Mobile --}}
        <div class="flex flex-col items-center gap-6 sm:hidden">
            <h2 class="text-lg font-bold text-white">Secciones</h2>
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-4">
                {{-- <a href="{{ route('nosotros') }}" class="text-[15px] text-white/80">Nosotros</a>
                <a href="{{ route('productos') }}" class="text-[15px] text-white/80">Productos</a>
                <a href="{{ route('calidad') }}" class="text-[15px] text-white/80">Calidad</a>
                <a href="{{ route('novedades') }}" class="text-[15px] text-white/80">Novedades</a>
                <a href="{{ route('contacto') }}" class="text-[15px] text-white/80">Contacto</a> --}}
            </div>
        </div>


        {{-- Newsletter --}}
        <div class="flex h-full flex-col items-center gap-6 lg:items-start lg:gap-10">
            <h2 class="text-lg font-bold text-white uppercase">Suscribite al Newsletter</h2>

            {{-- Mensaje de confirmación --}}
            <div id="newsletter-success"
                class="hidden w-full sm:w-[287px] p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">¡Te has suscrito correctamente al newsletter!</span>
                </div>
            </div>

            {{-- Mensaje de error --}}
            <div id="newsletter-error"
                class="hidden w-full sm:w-[287px] p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span id="newsletter-error-message" class="text-sm font-medium"></span>
                </div>
            </div>

            {{-- Formulario del newsletter --}}
            <form id="newsletter-form" {{-- action="{{ route('newsletter.store') }}" --}} method="POST"
                class="flex h-[44px] w-full items-center justify-between outline outline-white rounded-lg px-4 sm:w-[287px]">
                @csrf
                <input id="Email" name="email" type="email" required
                    class="w-full outline-none placeholder:text-white text-white" placeholder="Ingresa tu email" />
                <button type="submit" id="newsletter-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#0072C6" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>

        {{-- Datos de contacto --}}
        <div class="flex h-full flex-col items-center gap-6 lg:items-start lg:gap-10">
            <h2 class="text-lg font-bold text-white">Datos de contacto</h2>
            <div class="flex flex-col justify-center gap-4">
                @if(!empty($contacto->location))
                    <a href="https://maps.google.com/?q={{ urlencode($contacto->location) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 transition-opacity hover:opacity-80 max-w-[326px]">
                        <div class="shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M20 10C20 14.993 14.461 20.193 12.601 21.799C12.4277 21.9293 12.2168 21.9998 12 21.9998C11.7832 21.9998 11.5723 21.9293 11.399 21.799C9.539 20.193 4 14.993 4 10C4 7.87827 4.84285 5.84344 6.34315 4.34315C7.84344 2.84285 9.87827 2 12 2C14.1217 2 16.1566 2.84285 17.6569 4.34315C19.1571 5.84344 20 7.87827 20 10Z"
                                    stroke="#487AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                    stroke="#487AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <p class="text-base text-white/80 break-words">{{ $contacto->location }}</p>
                    </a>
                @endif

                @if(!empty($contacto->location_dos))
                    <a href="https://maps.google.com/?q={{ urlencode($contacto->location_dos) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 transition-opacity hover:opacity-80 max-w-[326px]">
                        <div class="shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M20 10C20 14.993 14.461 20.193 12.601 21.799C12.4277 21.9293 12.2168 21.9998 12 21.9998C11.7832 21.9998 11.5723 21.9293 11.399 21.799C9.539 20.193 4 14.993 4 10C4 7.87827 4.84285 5.84344 6.34315 4.34315C7.84344 2.84285 9.87827 2 12 2C14.1217 2 16.1566 2.84285 17.6569 4.34315C19.1571 5.84344 20 7.87827 20 10Z"
                                    stroke="#487AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                    stroke="#487AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <p class="text-base text-white/80 break-words">{{ $contacto->location_dos }}</p>
                    </a>
                @endif

                @if(!empty($contacto->mail))
                    <a href="mailto:{{ $contacto->mail }}"
                        class="flex items-center gap-3 transition-opacity hover:opacity-80">
                        <div class="shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M22 7L13.03 12.7C12.7213 12.8934 12.3643 12.996 12 12.996C11.6357 12.996 11.2787 12.8934 10.97 12.7L2 7M4 4H20C21.1046 4 22 4.89543 22 6V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V6C2 4.89543 2.89543 4 4 4Z"
                                    stroke="#487AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="text-base text-white/80 break-words">{{ $contacto->mail }}</p>
                    </a>
                @endif

                @if(!empty($contacto->phone))
                    <a href="tel:{{ preg_replace('/\s/', '', $contacto->phone) }}"
                        class="flex items-center gap-3 transition-opacity hover:opacity-80">
                        <div class="shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M22 16.9201V19.9201C22.0011 20.1986 21.9441 20.4743 21.8325 20.7294C21.7209 20.9846 21.5573 21.2137 21.3521 21.402C21.1468 21.5902 20.9046 21.7336 20.6407 21.8228C20.3769 21.912 20.0974 21.9452 19.82 21.9201C16.7428 21.5857 13.787 20.5342 11.19 18.8501C8.77382 17.3148 6.72533 15.2663 5.18999 12.8501C3.49997 10.2413 2.44824 7.27109 2.11999 4.1801C2.095 3.90356 2.12787 3.62486 2.21649 3.36172C2.30512 3.09859 2.44756 2.85679 2.63476 2.65172C2.82196 2.44665 3.0498 2.28281 3.30379 2.17062C3.55777 2.05843 3.83233 2.00036 4.10999 2.0001H7.10999C7.5953 1.99532 8.06579 2.16718 8.43376 2.48363C8.80173 2.80008 9.04207 3.23954 9.10999 3.7201C9.23662 4.68016 9.47144 5.62282 9.80999 6.5301C9.94454 6.88802 9.97366 7.27701 9.8939 7.65098C9.81415 8.02494 9.62886 8.36821 9.35999 8.6401L8.08999 9.9101C9.51355 12.4136 11.5864 14.4865 14.09 15.9101L15.36 14.6401C15.6319 14.3712 15.9751 14.1859 16.3491 14.1062C16.7231 14.0264 17.1121 14.0556 17.47 14.1901C18.3773 14.5286 19.3199 14.7635 20.28 14.8901C20.7658 14.9586 21.2094 15.2033 21.5265 15.5776C21.8437 15.9519 22.0122 16.4297 22 16.9201Z"
                                    stroke="#487AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="text-base text-white/80 break-words">{{ $contacto->phone }}</p>
                    </a>
                @endif

                @if(!empty($contacto->wp))
                    <a href="https://wa.me/{{ preg_replace('/\s/', '', $contacto->wp) }}" target="_blank"
                        rel="noopener noreferrer" class="flex items-center gap-3 transition-opacity hover:opacity-80">
                        <div class="shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M17 2.91005C16.0831 1.98416 14.991 1.25002 13.7875 0.750416C12.584 0.250812 11.2931 -0.00426317 9.99 5.38951e-05C4.53 5.38951e-05 0.0800002 4.45005 0.0800002 9.91005C0.0800002 11.6601 0.54 13.3601 1.4 14.8601L0 20.0001L5.25 18.6201C6.7 19.4101 8.33 19.8301 9.99 19.8301C15.45 19.8301 19.9 15.3801 19.9 9.92005C19.9 7.27005 18.87 4.78005 17 2.91005ZM9.99 18.1501C8.51 18.1501 7.06 17.7501 5.79 17.0001L5.49 16.8201L2.37 17.6401L3.2 14.6001L3 14.2901C2.17755 12.9771 1.74092 11.4593 1.74 9.91005C1.74 5.37005 5.44 1.67005 9.98 1.67005C12.18 1.67005 14.25 2.53005 15.8 4.09005C16.5676 4.85392 17.1759 5.7626 17.5896 6.76338C18.0033 7.76417 18.2142 8.83714 18.21 9.92005C18.23 14.4601 14.53 18.1501 9.99 18.1501ZM14.51 11.9901C14.26 11.8701 13.04 11.2701 12.82 11.1801C12.59 11.1001 12.43 11.0601 12.26 11.3001C12.09 11.5501 11.62 12.1101 11.48 12.2701C11.34 12.4401 11.19 12.4601 10.94 12.3301C10.69 12.2101 9.89 11.9401 8.95 11.1001C8.21 10.4401 7.72 9.63005 7.57 9.38005C7.43 9.13005 7.55 9.00005 7.68 8.87005C7.79 8.76005 7.93 8.58005 8.05 8.44005C8.17 8.30005 8.22 8.19005 8.3 8.03005C8.38 7.86005 8.34 7.72005 8.28 7.60005C8.22 7.48005 7.72 6.26005 7.52 5.76005C7.32 5.28005 7.11 5.34005 6.96 5.33005H6.48C6.31 5.33005 6.05 5.39005 5.82 5.64005C5.6 5.89005 4.96 6.49005 4.96 7.71005C4.96 8.93005 5.85 10.1101 5.97 10.2701C6.09 10.4401 7.72 12.9401 10.2 14.0101C10.79 14.2701 11.25 14.4201 11.61 14.5301C12.2 14.7201 12.74 14.6901 13.17 14.6301C13.65 14.5601 14.64 14.0301 14.84 13.4501C15.05 12.8701 15.05 12.3801 14.98 12.2701C14.91 12.1601 14.76 12.1101 14.51 11.9901Z"
                                    fill="#487AB7" />
                            </svg>
                        </div>
                        <p class="text-base text-white/80 break-words">{{ $contacto->wp }}</p>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div
        class="flex min-h-[67px] w-full flex-col items-center justify-center bg-black px-4 py-4 text-[14px] text-white/80 sm:flex-row sm:justify-between sm:px-6 lg:px-0">
        <div
            class="mx-auto flex w-full max-w-[1200px] flex-col items-center justify-center gap-2 text-center sm:flex-row sm:justify-between sm:gap-0 sm:text-left">
            <p>© Copyright {{ date('Y') }} Casa landau. Todos los derechos reservados</p>
            <a target="_blank" rel="noopener noreferrer" href="https://osole.com.ar/" class="mt-2 sm:mt-0">
                By <span class="font-bold">Osole</span>
            </a>
        </div>
    </div>
</div>

{{-- JavaScript para manejar el formulario del newsletter --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('newsletter-form');
        const successMessage = document.getElementById('newsletter-success');
        const errorMessage = document.getElementById('newsletter-error');
        const errorMessageText = document.getElementById('newsletter-error-message');
        const emailInput = document.getElementById('Email');
        const submitButton = document.getElementById('newsletter-btn');

        // Función para ocultar todos los mensajes
        function hideMessages() {
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
        }

        // Función para mostrar mensaje de éxito
        function showSuccess() {
            hideMessages();
            successMessage.classList.remove('hidden');
        }

        // Función para mostrar mensaje de error
        function showError(message) {
            hideMessages();
            errorMessageText.textContent = message;
            errorMessage.classList.remove('hidden');
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Ocultar mensajes previos
            hideMessages();

            // Deshabilitar el botón para evitar múltiples envíos
            submitButton.disabled = true;
            submitButton.innerHTML = '<svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

            // Crear FormData con los datos del formulario
            const formData = new FormData(form);

            // Realizar petición AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar mensaje de éxito
                        showSuccess();

                        // Limpiar el campo de email
                        emailInput.value = '';

                        // Ocultar el mensaje después de 5 segundos
                        setTimeout(function () {
                            hideMessages();
                        }, 5000);
                    } else {
                        // Manejar errores de validación
                        let errorMsg = 'Ocurrió un error al procesar tu solicitud';

                        if (data.errors && data.errors.email) {
                            errorMsg = data.errors.email[0];
                        } else if (data.message) {
                            errorMsg = data.message;
                        }

                        showError(errorMsg);

                        // Ocultar el mensaje de error después de 5 segundos
                        setTimeout(function () {
                            hideMessages();
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('Error de conexión. Por favor, intenta nuevamente.');

                    // Ocultar el mensaje de error después de 5 segundos
                    setTimeout(function () {
                        hideMessages();
                    }, 5000);
                })
                .finally(() => {
                    // Rehabilitar el botón
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#0072C6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>';
                });
        });
    });
</script>

{{-- Incluir Font Awesome si no está ya incluido --}}
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush