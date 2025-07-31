import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

const Navbar = () => {
    const { url } = usePage();
    const { logos, provincias, auth } = usePage().props;
    const user = auth.user;

    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [userMenu, setUserMenu] = useState(false);

    const privateLinks = [
        { title: 'Productos', href: '/privada/productos' },
        { title: 'Pedido', href: '/privada/carrito' },
        { title: 'Márgenes', href: '/privada/margenes' },

        { title: 'Mis pedidos', href: '/privada/pedidos' },
        { title: 'Lista de precios', href: '/privada/lista-de-precios' },
    ];

    return (
        <div className="sticky top-0 z-50 flex h-[100px] w-full flex-col bg-white shadow-sm transition-colors duration-300 max-sm:h-auto">
            {/* Contenido principal navbar */}
            {userMenu && <div className="fixed top-0 left-0 h-screen w-screen bg-black/50" />}
            <div className="mx-auto flex h-full w-[1200px] items-center justify-between max-sm:h-[60px] max-sm:w-full max-sm:px-4">
                <Link href="/">
                    <img src={logos?.logo_principal || ''} className="max-h-[84px] max-w-[124px] transition-all duration-300" alt="Logo" />
                </Link>

                {/* Navegación desktop */}
                <div className="hidden items-center gap-8 md:flex">
                    {privateLinks.map((link) => (
                        <Link
                            key={link.href}
                            href={link.href}
                            className={`hover:text-primary-orange text-[16px] font-normal text-black transition-colors duration-300 ${url === link.href.substring(1) ? 'font-bold' : ''} `}
                        >
                            {link.title}
                        </Link>
                    ))}
                </div>
                <div className="relative">
                    <button
                        onClick={() => setUserMenu(!userMenu)}
                        className={`bg-primary-orange hover:text-primary-orange hover:border-primary-orange h-[36px] w-[117px] rounded-sm text-sm text-white transition duration-300 hover:border hover:bg-transparent max-sm:h-[28px] max-sm:w-[120px] max-sm:px-2 max-sm:text-xs`}
                    >
                        <span className="max-sm:hidden">{user?.name}</span>
                    </button>
                    {userMenu && (
                        <div className="absolute right-0 -bottom-32 flex min-w-[200px] flex-col gap-4 rounded-sm bg-white p-4">
                            <p className="text-lg font-bold">Bienvenido, {user?.name}!</p>
                            <Link
                                method="post"
                                href={route('logout')}
                                className="bg-primary-orange flex items-center justify-center rounded-sm px-4 py-2 font-bold text-white"
                            >
                                Cerrar sesion
                            </Link>
                        </div>
                    )}
                </div>
            </div>

            {/* Menú móvil */}
            {mobileMenuOpen && (
                <div className="hidden border-t border-gray-200 bg-white shadow-lg max-sm:absolute max-sm:top-24 max-sm:block max-sm:w-full">
                    <div className="py-2">
                        {privateLinks.map((link) => (
                            <Link
                                key={link.href}
                                href={link.href}
                                className={`hover:text-primary-orange block px-4 py-3 text-sm text-gray-700 transition-colors duration-300 hover:bg-gray-50 ${url === link.href.substring(1) ? 'text-primary-orange bg-orange-50 font-bold' : ''} `}
                                onClick={() => setMobileMenuOpen(false)}
                            >
                                {link.title}
                            </Link>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
};

export default Navbar;
