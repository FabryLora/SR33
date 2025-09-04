import { Link, router, usePage } from '@inertiajs/react';
import { useState } from 'react';

const Footer = () => {
    const { logos, contacto } = usePage().props;

    const [formData, setFormData] = useState({ email: '' });
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [showSuccess, setShowSuccess] = useState(false);
    const [showError, setShowError] = useState(false);
    const [errorMessage, setErrorMessage] = useState('');

    const hideMessages = () => {
        setShowSuccess(false);
        setShowError(false);
    };

    const showSuccessMessage = () => {
        hideMessages();
        setShowSuccess(true);
        setTimeout(() => hideMessages(), 5000);
    };

    const showErrorMessage = (message) => {
        hideMessages();
        setErrorMessage(message);
        setShowError(true);
        setTimeout(() => hideMessages(), 5000);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsSubmitting(true);

        try {
            await router.post('/newsletter/store/public', formData, {
                preserveScroll: true,
                onSuccess: () => {
                    showSuccessMessage();
                    setFormData({ email: '' });
                },
                onError: (errors) => {
                    const errorMsg = errors.email ? errors.email[0] : 'Ocurrió un error al procesar tu solicitud';
                    showErrorMessage(errorMsg);
                },
            });
        } catch (error) {
            showErrorMessage('Error de conexión. Por favor, intenta nuevamente.');
        } finally {
            setIsSubmitting(false);
        }
    };

    const handleInputChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const currentYear = new Date().getFullYear();

    // Helper function to clean phone numbers for tel: links
    const cleanPhoneNumber = (phone) => {
        return phone ? phone.replace(/\s/g, '') : '';
    };

    return (
        <div className="flex h-fit w-full flex-col bg-black">
            <div className="mx-auto flex h-full w-full max-w-[1200px] flex-col items-center justify-between gap-20 px-4 py-10 lg:flex-row lg:items-start lg:px-0 lg:py-26">
                {/* Logo y redes sociales */}
                <div className="flex h-full flex-col items-center gap-4">
                    <Link href="/">
                        <img src={logos?.logo_principal || ''} alt="Logo secundario" className="max-h-[84px] max-w-[124px] sm:max-w-full" />
                    </Link>

                    <div className="flex flex-row items-center justify-center gap-4 sm:gap-2">
                        {contacto?.ig && (
                            <a target="_blank" rel="noopener noreferrer" href={contacto.ig} aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M5.8 0H14.2C17.4 0 20 2.6 20 5.8V14.2C20 15.7383 19.3889 17.2135 18.3012 18.3012C17.2135 19.3889 15.7383 20 14.2 20H5.8C2.6 20 0 17.4 0 14.2V5.8C0 4.26174 0.61107 2.78649 1.69878 1.69878C2.78649 0.61107 4.26174 0 5.8 0ZM5.6 2C4.64522 2 3.72955 2.37928 3.05442 3.05442C2.37928 3.72955 2 4.64522 2 5.6V14.4C2 16.39 3.61 18 5.6 18H14.4C15.3548 18 16.2705 17.6207 16.9456 16.9456C17.6207 16.2705 18 15.3548 18 14.4V5.6C18 3.61 16.39 2 14.4 2H5.6ZM15.25 3.5C15.5815 3.5 15.8995 3.6317 16.1339 3.86612C16.3683 4.10054 16.5 4.41848 16.5 4.75C16.5 5.08152 16.3683 5.39946 16.1339 5.63388C15.8995 5.8683 15.5815 6 15.25 6C14.9185 6 14.6005 5.8683 14.3661 5.63388C14.1317 5.39946 14 5.08152 14 4.75C14 4.41848 14.1317 4.10054 14.3661 3.86612C14.6005 3.6317 14.9185 3.5 15.25 3.5ZM10 5C11.3261 5 12.5979 5.52678 13.5355 6.46447C14.4732 7.40215 15 8.67392 15 10C15 11.3261 14.4732 12.5979 13.5355 13.5355C12.5979 14.4732 11.3261 15 10 15C8.67392 15 7.40215 14.4732 6.46447 13.5355C5.52678 12.5979 5 11.3261 5 10C5 8.67392 5.52678 7.40215 6.46447 6.46447C7.40215 5.52678 8.67392 5 10 5ZM10 7C9.20435 7 8.44129 7.31607 7.87868 7.87868C7.31607 8.44129 7 9.20435 7 10C7 10.7956 7.31607 11.5587 7.87868 12.1213C8.44129 12.6839 9.20435 13 10 13C10.7956 13 11.5587 12.6839 12.1213 12.1213C12.6839 11.5587 13 10.7956 13 10C13 9.20435 12.6839 8.44129 12.1213 7.87868C11.5587 7.31607 10.7956 7 10 7Z"
                                        fill="#0992C9"
                                    />
                                </svg>
                            </a>
                        )}

                        {contacto?.fb && (
                            <a target="_blank" rel="noopener noreferrer" href={contacto.fb} aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M20 10C20 4.48 15.52 0 10 0C4.48 0 0 4.48 0 10C0 14.84 3.44 18.87 8 19.8V13H6V10H8V7.5C8 5.57 9.57 4 11.5 4H14V7H12C11.45 7 11 7.45 11 8V10H14V13H11V19.95C16.05 19.45 20 15.19 20 10Z"
                                        fill="#0992C9"
                                    />
                                </svg>
                            </a>
                        )}
                    </div>
                </div>

                {/* Newsletter */}
                <div className="flex h-full flex-col items-center gap-6 lg:items-start lg:gap-10">
                    <h2 className="text-lg font-bold text-white uppercase">Suscribite al Newsletter</h2>

                    {/* Mensaje de confirmación */}
                    {showSuccess && (
                        <div className="w-full rounded border border-green-400 bg-green-100 p-4 text-green-700 sm:w-[287px]">
                            <div className="flex items-center">
                                <svg className="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fillRule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                                <span className="text-sm font-medium">¡Te has suscrito correctamente al newsletter!</span>
                            </div>
                        </div>
                    )}

                    {/* Mensaje de error */}
                    {showError && (
                        <div className="w-full rounded border border-red-400 bg-red-100 p-4 text-red-700 sm:w-[287px]">
                            <div className="flex items-center">
                                <svg className="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fillRule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                                <span className="text-sm font-medium">{errorMessage}</span>
                            </div>
                        </div>
                    )}

                    {/* Formulario del newsletter */}
                    <form
                        onSubmit={handleSubmit}
                        className="flex h-[44px] w-full items-center justify-between rounded-lg px-4 outline outline-white sm:w-[287px]"
                    >
                        <input
                            name="email"
                            type="email"
                            required
                            value={formData.email}
                            onChange={handleInputChange}
                            className="w-full bg-transparent text-white outline-none placeholder:text-white"
                            placeholder="Ingresa tu email"
                        />
                        <button type="submit" disabled={isSubmitting}>
                            {isSubmitting ? (
                                <svg className="h-4 w-4 animate-spin" viewBox="0 0 24 24">
                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                    <path
                                        className="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    />
                                </svg>
                            ) : (
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M1 8H15M15 8L8 1M15 8L8 15"
                                        stroke="#0072C6"
                                        strokeWidth="2"
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                    />
                                </svg>
                            )}
                        </button>
                    </form>
                </div>

                {/* Datos de contacto */}
                <div className="flex h-full flex-col items-center gap-6 lg:items-start lg:gap-10">
                    <h2 className="text-lg font-bold text-white">Datos de contacto</h2>
                    <div className="flex flex-col justify-center gap-4">
                        {contacto?.location && (
                            <a
                                href={`https://maps.google.com/?q=${encodeURIComponent(contacto.location)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="flex max-w-[326px] items-center gap-3 transition-opacity hover:opacity-80"
                            >
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M16.6666 8.33329C16.6666 13.3333 9.99992 18.3333 9.99992 18.3333C9.99992 18.3333 3.33325 13.3333 3.33325 8.33329C3.33325 6.56518 4.03563 4.86949 5.28587 3.61925C6.53612 2.369 8.23181 1.66663 9.99992 1.66663C11.768 1.66663 13.4637 2.369 14.714 3.61925C15.9642 4.86949 16.6666 6.56518 16.6666 8.33329Z"
                                            stroke="#0992C9"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M10 10.8334C11.3807 10.8334 12.5 9.71409 12.5 8.33337C12.5 6.95266 11.3807 5.83337 10 5.83337C8.61929 5.83337 7.5 6.95266 7.5 8.33337C7.5 9.71409 8.61929 10.8334 10 10.8334Z"
                                            stroke="#0992C9"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </div>
                                <p className="text-base break-words text-white/80">{contacto.location}</p>
                            </a>
                        )}

                        {contacto?.phone && (
                            <a
                                href={`tel:${cleanPhoneNumber(contacto.phone)}`}
                                className="flex items-center gap-3 transition-opacity hover:opacity-80"
                            >
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_9732_312)">
                                            <path
                                                d="M18.3334 14.1V16.6C18.3344 16.8321 18.2868 17.0618 18.1939 17.2745C18.1009 17.4871 17.9645 17.678 17.7935 17.8349C17.6225 17.9918 17.4206 18.1113 17.2007 18.1856C16.9809 18.26 16.7479 18.2876 16.5168 18.2667C13.9525 17.9881 11.4893 17.1118 9.32511 15.7084C7.31163 14.4289 5.60455 12.7219 4.32511 10.7084C2.91676 8.53438 2.04031 6.0592 1.76677 3.48337C1.74595 3.25293 1.77334 3.02067 1.84719 2.80139C1.92105 2.58211 2.03975 2.38061 2.19575 2.20972C2.35174 2.03883 2.54161 1.9023 2.75327 1.80881C2.96492 1.71532 3.19372 1.66692 3.42511 1.66671H5.92511C6.32953 1.66273 6.7216 1.80594 7.02824 2.06965C7.33488 2.33336 7.53517 2.69958 7.59177 3.10004C7.69729 3.9001 7.89298 4.68565 8.17511 5.44171C8.28723 5.73998 8.31149 6.06414 8.24503 6.37577C8.17857 6.68741 8.02416 6.97347 7.80011 7.20004L6.74177 8.25837C7.92807 10.3447 9.65549 12.0721 11.7418 13.2584L12.8001 12.2C13.0267 11.976 13.3127 11.8216 13.6244 11.7551C13.936 11.6887 14.2602 11.7129 14.5584 11.825C15.3145 12.1072 16.1001 12.3029 16.9001 12.4084C17.3049 12.4655 17.6746 12.6694 17.9389 12.9813C18.2032 13.2932 18.3436 13.6914 18.3334 14.1Z"
                                                stroke="#0992C9"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_9732_312">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <p className="text-base break-words text-white/80">{contacto.phone}</p>
                            </a>
                        )}

                        {contacto?.mail && (
                            <a href={`mailto:${contacto.mail}`} className="flex items-center gap-3 transition-opacity hover:opacity-80">
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M16.6667 3.33337H3.33341C2.41294 3.33337 1.66675 4.07957 1.66675 5.00004V15C1.66675 15.9205 2.41294 16.6667 3.33341 16.6667H16.6667C17.5872 16.6667 18.3334 15.9205 18.3334 15V5.00004C18.3334 4.07957 17.5872 3.33337 16.6667 3.33337Z"
                                            stroke="#0992C9"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M18.3334 5.83337L10.8584 10.5834C10.6011 10.7446 10.3037 10.8301 10.0001 10.8301C9.69648 10.8301 9.39902 10.7446 9.14175 10.5834L1.66675 5.83337"
                                            stroke="#0992C9"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </div>
                                <p className="text-base break-words text-white/80">{contacto.mail}</p>
                            </a>
                        )}

                        {contacto?.wp && (
                            <a
                                href={`https://wa.me/${cleanPhoneNumber(contacto.wp)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="flex items-center gap-3 transition-opacity hover:opacity-80"
                            >
                                <div className="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M14.5823 11.985C14.3328 11.8608 13.1095 11.2625 12.8817 11.1792C12.6539 11.0967 12.4881 11.0558 12.3215 11.3042C12.1557 11.5508 11.6793 12.1092 11.5344 12.2742C11.3887 12.44 11.2438 12.46 10.9952 12.3367C10.7465 12.2117 9.94429 11.9508 8.99391 11.1075C8.25453 10.4509 7.75464 9.64002 7.60978 9.39169C7.46492 9.14419 7.59387 9.01002 7.71863 8.88669C7.83084 8.77585 7.96732 8.59752 8.09209 8.45335C8.21685 8.30835 8.25788 8.20502 8.34078 8.03919C8.42451 7.87419 8.38265 7.73002 8.31985 7.60585C8.25788 7.48169 7.7605 6.26252 7.55284 5.76669C7.35104 5.28419 7.14589 5.35003 6.99349 5.34169C6.8478 5.33503 6.682 5.33336 6.51621 5.33336C6.35041 5.33336 6.08079 5.39503 5.85303 5.64336C5.62444 5.89086 4.98219 6.49002 4.98219 7.70919C4.98219 8.92752 5.87313 10.105 5.99789 10.2709C6.12266 10.4359 7.75213 12.9375 10.2482 14.01C10.8428 14.265 11.3058 14.4175 11.6667 14.5308C12.2629 14.72 12.8055 14.6933 13.2342 14.6292C13.7115 14.5583 14.7063 14.03 14.9139 13.4517C15.1208 12.8733 15.1208 12.3775 15.0588 12.2742C14.9968 12.1708 14.831 12.1092 14.5815 11.985H14.5823ZM10.0423 18.1542H10.0389C8.55634 18.1544 7.10099 17.7578 5.8254 17.0058L5.52396 16.8275L2.39062 17.6458L3.22712 14.6058L3.03035 14.2942C2.20149 12.9811 1.76286 11.4615 1.76512 9.91085C1.7668 5.36919 5.47958 1.6742 10.0456 1.6742C12.2562 1.6742 14.3345 2.53253 15.897 4.08919C16.6676 4.85301 17.2785 5.76133 17.6941 6.7616C18.1098 7.76188 18.322 8.83425 18.3186 9.91668C18.3169 14.4583 14.6041 18.1542 10.0423 18.1542ZM17.086 2.9067C16.1634 1.98247 15.0657 1.24965 13.8564 0.7507C12.6472 0.251754 11.3505 -0.00339687 10.0414 3.41479e-05C4.55347 3.41479e-05 0.0854091 4.44586 0.0837344 9.91002C0.0811914 11.649 0.539563 13.3578 1.4126 14.8642L0 20L5.27861 18.6217C6.73884 19.4134 8.37519 19.8283 10.0381 19.8283H10.0423C15.5302 19.8283 19.9983 15.3825 20 9.91752C20.004 8.61525 19.7485 7.32511 19.2484 6.12172C18.7482 4.91833 18.0132 3.82559 17.086 2.9067Z"
                                            fill="#0992C9"
                                        />
                                    </svg>
                                </div>
                                <p className="text-base break-words text-white/80">{contacto.wp}</p>
                            </a>
                        )}
                    </div>
                </div>
            </div>

            {/* Copyright */}
            <div className="flex min-h-[67px] w-full flex-col items-center justify-center bg-black px-4 py-4 text-[14px] text-white/80 sm:flex-row sm:justify-between sm:px-6 lg:px-0">
                <div className="mx-auto flex w-full max-w-[1200px] flex-col items-center justify-center gap-2 text-center sm:flex-row sm:justify-between sm:gap-0 sm:text-left">
                    <p>&copy; Copyright {currentYear} VDR SR33. Todos los derechos reservados</p>
                    <a target="_blank" rel="noopener noreferrer" href="https://osole.com.ar/" className="mt-2 sm:mt-0">
                        By <span className="font-bold">Osole</span>
                    </a>
                </div>
            </div>
        </div>
    );
};

export default Footer;
