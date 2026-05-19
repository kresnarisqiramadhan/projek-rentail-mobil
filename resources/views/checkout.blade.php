<x-layout>
    @if ($errors->any())
        <div class="max-w-[1440px] mx-auto pt-8 pb-0 px-6 md:px-12">
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @php
        $vehicle = null;
        if (request()->has('vehicle_id')) {
            $vehicle = \App\Models\Vehicle::find(request('vehicle_id'));
        }
        if (!$vehicle) {
            header('Location: ' . route('vehicles'));
            exit;
        }
    @endphp

    <div class="max-w-[1440px] mx-auto pt-8 pb-32 px-6 md:px-12 min-h-screen"
         x-data="{
            paymentMethod: 'bank',
            startDate: '',
            endDate: '',
            insurance: 'allrisk',
            get days() {
                if (this.startDate && this.endDate) {
                    let start = new Date(this.startDate);
                    let end = new Date(this.endDate);
                    let diff = end - start;
                    return Math.ceil(diff / (1000 * 60 * 60 * 24));
                }
                return 0;
            },
            get rentalTotal() {
                return this.days * {{ $vehicle->price_per_day }};
            },
            get insuranceTotal() {
                return this.insurance === 'allrisk' ? this.days * 85000 : this.days * 35000;
            },
            get serviceFee() {
                return 150000;
            },
            get tax() {
                return Math.round((this.rentalTotal + this.insuranceTotal + this.serviceFee) * 0.11);
            },
            get grandTotal() {
                return this.rentalTotal + this.insuranceTotal + this.serviceFee + this.tax;
            }
         }"
         x-init="startDate = new Date().toISOString().split('T')[0]; endDate = new Date(Date.now() + 3*86400000).toISOString().split('T')[0]">

        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Checkout</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Lengkapi reservasi Anda untuk pengalaman berkendara terbaik.</p>
        </div>

        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
            <input type="hidden" name="start_date" x-model="startDate">
            <input type="hidden" name="end_date" x-model="endDate">
            <input type="hidden" name="insurance" x-model="insurance">
            <input type="hidden" name="payment_method" x-model="paymentMethod">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Kiri: Formulir Checkout -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Langkah 1: Data Diri -->
                <section class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 flex items-center justify-center font-bold">1</div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Data Diri</h2>
                    </div>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Alamat Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" readonly class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none">
                        </div>
                    </div>
                </section>

                <!-- Langkah 2: Opsi Sewa -->
                <section class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 flex items-center justify-center font-bold">2</div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Opsi Sewa</h2>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Tanggal Mulai</label>
                            <input type="date" x-model="startDate" required class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Tanggal Kembali</label>
                            <input type="date" x-model="endDate" required class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                        </div>
                    </div>
                    <div class="space-y-4 mt-4">
                        <label class="flex items-center justify-between p-6 bg-zinc-50 dark:bg-zinc-800 rounded-3xl border border-zinc-100 dark:border-zinc-700 cursor-pointer group hover:border-zinc-900 dark:hover:border-zinc-50 transition-all" @click="insurance = 'allrisk'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="insurance" value="allrisk" x-model="insurance" class="w-5 h-5 text-zinc-900 focus:ring-0">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-zinc-50">All Risk</p>
                                    <p class="text-xs text-zinc-500">Perlindungan penuh tanpa deductible.</p>
                                </div>
                            </div>
                            <span class="font-bold text-zinc-900 dark:text-zinc-50">Rp85.000/hari</span>
                        </label>
                        <label class="flex items-center justify-between p-6 bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-700 cursor-pointer group hover:border-zinc-900 dark:hover:border-zinc-50 transition-all" @click="insurance = 'tlo'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="insurance" value="tlo" x-model="insurance" class="w-5 h-5 text-zinc-900 focus:ring-0">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-zinc-50">TLO</p>
                                    <p class="text-xs text-zinc-500">Perlindungan Total Loss Only.</p>
                                </div>
                            </div>
                            <span class="font-bold text-zinc-900 dark:text-zinc-50">Rp35.000/hari</span>
                        </label>
                    </div>
                </section>

                <!-- Langkah 3: Metode Pembayaran -->
                <section class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 flex items-center justify-center font-bold">3</div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Metode Pembayaran</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button type="button" @click="paymentMethod = 'bank'" :class="paymentMethod === 'bank' ? 'border-2 border-zinc-900 dark:border-zinc-50 bg-zinc-50 dark:bg-zinc-800' : 'border border-zinc-100 dark:border-zinc-700 bg-white dark:bg-zinc-900'" class="flex flex-col items-center justify-center p-8 rounded-3xl gap-3 group transition-all">
                            <span class="material-symbols-outlined text-4xl" :class="paymentMethod === 'bank' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">credit_card</span>
                            <span class="font-bold" :class="paymentMethod === 'bank' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">Transfer Bank</span>
                        </button>
                        <button type="button" @click="paymentMethod = 'qris'" :class="paymentMethod === 'qris' ? 'border-2 border-zinc-900 dark:border-zinc-50 bg-zinc-50 dark:bg-zinc-800' : 'border border-zinc-100 dark:border-zinc-700 bg-white dark:bg-zinc-900'" class="flex flex-col items-center justify-center p-8 rounded-3xl gap-3 group transition-all">
                            <span class="material-symbols-outlined text-4xl" :class="paymentMethod === 'qris' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">qr_code</span>
                            <span class="font-bold" :class="paymentMethod === 'qris' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">QRIS</span>
                        </button>
                    </div>
                </section>
            </div>

            <!-- Kanan: Ringkasan -->
            <div class="lg:col-span-4">
                <div class="bg-zinc-900 text-white rounded-[2.5rem] p-10 sticky top-24 shadow-2xl">
                    <h2 class="text-2xl font-bold mb-8">Ringkasan Reservasi</h2>

                    <div class="flex gap-6 mb-10 pb-8 border-b border-zinc-800">
                        <div class="w-24 h-24 rounded-2xl bg-zinc-800 overflow-hidden flex-shrink-0">
                            @if($vehicle->photos->first())
                                <img src="{{ asset('storage/' . $vehicle->photos->first()->path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-500">
                                    <span class="material-symbols-outlined text-3xl">directions_car</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">{{ $vehicle->name }}</h3>
                            <p class="text-zinc-500 text-sm" x-text="days + ' Hari Sewa'"></p>
                            <p class="text-zinc-400 text-xs mt-1" x-text="startDate + ' — ' + endDate"></p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-10">
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Tarif Sewa</span>
                            <span x-text="'Rp' + rentalTotal.toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Asuransi</span>
                            <span x-text="'Rp' + insuranceTotal.toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Biaya Layanan</span>
                            <span x-text="'Rp' + serviceFee.toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>PPN (11%)</span>
                            <span x-text="'Rp' + tax.toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-8 border-t border-zinc-800 mb-10">
                        <span class="text-lg font-medium">Total Harga</span>
                        <span class="text-3xl font-bold" x-text="'Rp' + grandTotal.toLocaleString('id-ID')"></span>
                    </div>

                    <button type="submit" class="w-full h-16 bg-white text-zinc-900 rounded-full flex items-center justify-center font-bold text-lg hover:bg-zinc-100 transition-colors">
                        Lanjutkan ke Pembayaran
                    </button>

                    <div class="flex items-center justify-center gap-2 mt-6 text-[10px] text-zinc-500 uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        Transaksi Aman Terenkripsi
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-layout>
