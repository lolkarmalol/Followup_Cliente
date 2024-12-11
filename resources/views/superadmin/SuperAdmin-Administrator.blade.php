<!DOCTYPE html>
<html lang="es">
@include('partials.head')

<body class="font-['Arial',sans-serif] bg-white m-0 flex flex-col min-h-screen">
    @include('partials.header')
    @yield('content')
    @include('partials.nav')
    <main class="relative flex flex-col items-center mt-4">
        <div class="flex items-center justify-between w-full mb-4">
            <a href="{{ route('superadmin.home') }}" class="ml-4">
                <img src="{{ asset('img/flecha.png') }}" alt="Flecha" class="w-5 h-auto">
            </a>
            <form class="flex items-center gap-2 mb-4" onsubmit="return false;">
                <input type="text" id="searchInput" placeholder="Buscar por nombre o identificación"
                    class="px-2 py-1 text-sm border border-black rounded-full w-96" />
                <button aria-label="Buscar" class="p-2 -ml-10 bg-transparent border-none cursor-pointer">
                    <img src="{{ asset('img/lupa.png') }}" alt="Buscar" class="w-4 h-auto">
                </button>
            </form>


            <form action="#" method="GET" class="mr-8">
                <a href="{{ route('superadmin.SuperAdmin-AdministratorAñadir') }}" type="button"
                    class="p-2 bg-white border-none cursor-pointer">
                    <img src="{{ asset('img/mas.png') }}" alt="Agregar" class="w-5 h-auto">
                </a>
            </form>
        </div>
        <div
            class="w-full max-w-6xl bg-[#2f3e4c14] border-2 border-[#04324D] rounded-lg p-6 shadow-[0_0_10px_rgba(0,0,0,0.8)] mt-1">
            <div id="resultContainer" <div
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6">
                @php
                    $contador = 0;
                @endphp
                @foreach ($users as $user)
                    <a href="{{ route('superadmin.SuperAdmin-AdministratorPerfil', ['id' => $user['id']]) }}"
                        class="w-40 h-30 bg-white border-2 border-[#009E00] rounded-2xl m-4 p-2 flex flex-col items-center hover:bg-green-100">
                        <img src="{{ asset('img/administrador/administrador.png') }}" alt="User"
                            class="w-8 h-8 mb-1">
                        <span class="p-1 text-xs text-center">{{ $user['name'] }} {{ $user['last_name'] }}</span>
                        <span class="p-1 text-xs text-center">{{ $user['identification'] }}</span>
                        <span class="p-1 text-xs text-center">{{ $user['department'] }}</span>
                        <span class="p-1 text-xs text-center">{{ $user['role']['role_type'] }}</span>

                    </a>
                    @php
                        $contador++;
                    @endphp
                @endforeach
            </div>
        </div>

        </div>

        <div class="m-4 mt-4 text-sm text-center text-gray-500">Total de registros: {{ $contador }}</div>
    </main>
    <script src="{{ asset('js/SuperAdmin.js') }}"></script>
    <script>
        const searchInput = document.getElementById('searchInput');
        const resultContainer = document.getElementById('resultContainer');

        searchInput.addEventListener('keyup', () => {
            const query = searchInput.value.trim();

            fetch(`/superadmin/SuperAdmin-Administrator?search=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar los resultados');
                    }
                    return response.text();
                })
                .then(html => {
                    resultContainer.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultContainer.innerHTML =
                        `<p class="text-center text-red-500 col-span-full">Error al cargar resultados. Intenta de nuevo.</p>`;
                });
        });
    </script>
</body>

</html>
