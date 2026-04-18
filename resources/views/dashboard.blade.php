<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold mb-0 text-dark tracking-tight">
                <i class="bi bi-grid-1x2-fill text-primary me-2"></i> Dashboard Overview
            </h2>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Add Transaction
            </a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container-fluid max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Toast Container (Notification) -->
            <div class="toast-container position-fixed bottom-0 end-0 p-4" style="z-index: 1055;">
                @if(session('success'))
                    <div id="successToast" class="toast align-items-center text-white border-0 shadow-lg rounded-4 overflow-hidden" role="alert" aria-live="assertive" aria-atomic="true" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                        <div class="d-flex">
                            <div class="toast-body fw-medium d-flex align-items-center px-4 py-3" style="font-size: 0.95rem;">
                                <i class="bi bi-check-circle-fill fs-4 me-3 text-white"></i> {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Top Filter Row -->
            <div class="d-flex justify-content-between align-items-end mb-4 px-2">
                <div>
                    <h5 class="fw-bold text-muted mb-1 text-uppercase" style="letter-spacing: 1px; font-size: 0.8rem;">Filter Records</h5>
                    <form method="GET" action="{{ route('dashboard') }}" class="d-flex align-items-center gap-2">
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0 rounded-start-pill text-muted"><i class="bi bi-calendar-event"></i></span>
                            <input type="month" id="month" name="month" class="form-control border-start-0 rounded-end-pill focus-ring-none bg-white py-2 fw-medium" style="border-color: #dee2e6;" value="{{ $month }}" onchange="this.form.submit()">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-md-4">
                    <div class="glass-card card h-100 position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted fw-semibold mb-0">Total Income</h6>
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-arrow-down-left fs-4"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold text-dark mb-0">৳{{ number_format($totalIncome, 2) }}</h2>
                        </div>
                        <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, #28a745, #20c997);"></div>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="glass-card card h-100 position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted fw-semibold mb-0">Total Expense</h6>
                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-arrow-up-right fs-4"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold text-dark mb-0">৳{{ number_format($totalExpense, 2) }}</h2>
                        </div>
                        <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, #dc3545, #fd7e14);"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="glass-card card h-100 position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted fw-semibold mb-0">Net Balance</h6>
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-wallet2 fs-4"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold text-dark mb-0">৳{{ number_format($balance, 2) }}</h2>
                        </div>
                        <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, #0d6efd, #6610f2);"></div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Transactions Table -->
                <div class="col-12 col-xl-8">
                    <div class="glass-card card p-4 h-100">
                        <h5 class="fw-bold mb-4">Recent Transactions</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle mb-0">
                                <thead style="border-bottom: 2px solid #f1f3f8;">
                                    <tr>
                                        <th class="text-muted fw-medium text-uppercase pb-3" style="font-size: 0.85rem; letter-spacing: 0.5px;">Date</th>
                                        <th class="text-muted fw-medium text-uppercase pb-3" style="font-size: 0.85rem; letter-spacing: 0.5px;">Category</th>
                                        <th class="text-muted fw-medium text-uppercase pb-3" style="font-size: 0.85rem; letter-spacing: 0.5px;">Type</th>
                                        <th class="text-muted fw-medium text-uppercase pb-3" style="font-size: 0.85rem; letter-spacing: 0.5px;">Amount</th>
                                        <th class="text-muted fw-medium text-uppercase text-end pb-3" style="font-size: 0.85rem; letter-spacing: 0.5px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                        <tr style="border-bottom: 1px solid #f8f9fc;">
                                            <td class="py-3">
                                                <div class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($transaction->date)->format('M d') }}</div>
                                                <div class="text-muted" style="font-size: 0.8rem;">{{ \Carbon\Carbon::parse($transaction->date)->format('Y') }}</div>
                                            </td>
                                            <td class="py-3 text-secondary fw-medium">
                                                <div class="d-flex align-items-center">
                                                    <span class="bg-light rounded p-2 me-2 text-dark"><i class="bi bi-tag"></i></span>
                                                    {{ ucfirst($transaction->category) }}
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                @if($transaction->type === 'income')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-medium">
                                                        Income
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-medium">
                                                        Expense
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 fw-bold {{ $transaction->type === 'income' ? 'text-success' : 'text-dark' }}">
                                                {{ $transaction->type === 'income' ? '+' : '-' }}৳{{ number_format($transaction->amount, 2) }}
                                            </td>
                                            <td class="py-3 text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-light text-primary rounded-circle shadow-sm" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s;">
                                                        <i class="bi bi-pencil-fill" style="font-size: 0.8rem;"></i>
                                                    </a>
                                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s;">
                                                            <i class="bi bi-trash3-fill" style="font-size: 0.8rem;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="text-muted d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                                                        <i class="bi bi-receipt fs-1 text-primary"></i>
                                                    </div>
                                                    <h5 class="fw-bold text-dark mb-1">No Transactions Found</h5>
                                                    <span class="fw-normal mb-4">You haven't logged any expenses for this month yet.</span>
                                                    <a href="{{ route('transactions.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold"><i class="bi bi-plus-lg me-1"></i> Add Your First Record</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Monthly Analytics Chart -->
                <div class="col-12 col-xl-4">
                    <div class="glass-card card p-4 h-100">
                        <h5 class="fw-bold mb-4">Analytics</h5>
                        @if($expenseByCategory->isEmpty())
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                <i class="bi bi-pie-chart text-light fs-1 mb-2"></i>
                                <p class="mb-0 fw-medium">No expense data available.</p>
                            </div>
                        @else
                            <div class="position-relative w-100 d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                <canvas id="expenseChart" style="max-height: 350px;"></canvas>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($expenseByCategory->isNotEmpty())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('expenseChart').getContext('2d');
                const labels = {!! json_encode($expenseByCategory->keys()) !!};
                const data = {!! json_encode($expenseByCategory->values()) !!};

                // Modern premium gradient colors
                const colorPalette = [
                    '#4318FF', '#39B8FF', '#FFB547', '#01B574', '#EE5D50', '#8F9BBA'
                ];

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: data.map((_, i) => colorPalette[i % colorPalette.length]),
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        family: "'Inter', sans-serif",
                                        size: 13,
                                        weight: '500'
                                    },
                                    color: '#A3AED0'
                                }
                            },
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>
    @endif
    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var toastEl = document.getElementById('successToast');
                var toast = new bootstrap.Toast(toastEl, { delay: 4000, animation: true });
                toast.show();
            });
        </script>
    @endif
</x-app-layout>
