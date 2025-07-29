import MispedidosRow from '@/components/mispedidosRow';
import { Head, usePage } from '@inertiajs/react';
import DefaultLayout from '../defaultLayout';

export default function Mispedidos() {
    const { pedidos } = usePage().props;

    return (
        <DefaultLayout>
            <Head>
                <title>Pedidos</title>
            </Head>
            <div className="mx-auto min-h-[40vh] w-[1200px] py-20">
                <div className="col-span-2 grid w-full items-start">
                    <div className="w-full">
                        <div className="grid h-[52px] grid-cols-7 items-center bg-[#F5F5F5]">
                            <p></p>
                            <p>Nº de pedido</p>
                            <p>Fecha de compra</p>
                            <p>Estado</p>
                            <p>Importe</p>
                            <p></p>
                            <p></p>
                        </div>
                        {pedidos?.map((pedido) => <MispedidosRow key={pedido?.id} pedido={pedido} />)}
                    </div>
                </div>
            </div>
        </DefaultLayout>
    );
}
