<x-filament-panels::page>

<style>
    /* Modern Profile Styling */
    .profile-header-card {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(99, 102, 241, 0.3);
        position: relative;
        overflow: hidden;
    }

    .profile-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .profile-header-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .profile-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .profile-avatar-wrapper {
        position: relative;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
    }

    .profile-status-indicator {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        background: #10b981;
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .profile-info h2 {
        font-size: 1.875rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
        color: #fff;
    }

    .profile-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 700;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 0.75rem;
    }

    .profile-joined {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
        border-radius: 1rem;
        padding: 1.75rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dark .stat-card {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border-color: #334155;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.05));
        border-radius: 0 1rem 0 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(99, 102, 241, 0.15);
        border-color: #cbd5e1;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .stat-icon-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .stat-icon-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .stat-icon-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .stat-icon-info {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .dark .stat-label {
        color: #94a3b8;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
    }

    .dark .stat-value {
        color: #f8fafc;
    }

    /* Details Section */
    .details-section {
        background: #fff;
        border-radius: 1rem;
        padding: 2rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .dark .details-section {
        background: #1e293b;
        border-color: #334155;
    }

    .details-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .dark .details-header {
        border-bottom-color: #334155;
    }

    .details-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .details-header h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .dark .details-header h3 {
        color: #f8fafc;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .dark .detail-item {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-color: #334155;
    }

    .detail-item:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .dark .detail-item:hover {
        background: #334155;
    }

    .detail-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dark .detail-label {
        color: #94a3b8;
    }

    .detail-label i {
        color: #6366f1;
    }

    .detail-value {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e293b;
        word-break: break-word;
    }

    .dark .detail-value {
        color: #f8fafc;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-header-content {
            flex-direction: column;
            text-align: center;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stats-grid,
        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Profile Header Card -->
<div class="profile-header-card">
    <div class="profile-header-content">
        <div class="profile-avatar-wrapper">
            <img
                src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=4F46E5&color=fff&size=240' }}"
                alt="{{ auth()->user()->name }}"
                class="profile-avatar"
            />
            <div class="profile-status-indicator"></div>
        </div>

        <div class="profile-info">
            <h2>{{ auth()->user()->name }}</h2>

            <div class="profile-role-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                {{ auth()->user()->roles->pluck('name')->join(', ') }}
            </div>

            <div class="profile-joined">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Joined {{ auth()->user()->created_at->format('d M, Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon stat-icon-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>
        <div class="stat-label">Account Status</div>
        <div class="stat-value">Active</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <div class="stat-label">Profile Complete</div>
        <div class="stat-value">100%</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
        </div>
        <div class="stat-label">Security Level</div>
        <div class="stat-value">High</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-info">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </div>
        <div class="stat-label">Member Since</div>
        <div class="stat-value">{{ auth()->user()->created_at->diffForHumans(null, true) }}</div>
    </div>
</div>

<!-- Profile Details Section -->
<div class="details-section">
    <div class="details-header">
        <div class="details-header-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>
        <h3>Profile Information</h3>
    </div>

    <div class="details-grid">
        <div class="detail-item">
            <div class="detail-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Full Name
            </div>
            <div class="detail-value">{{ auth()->user()->name }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                Email Address
            </div>
            <div class="detail-value">{{ auth()->user()->email }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Designation
            </div>
            <div class="detail-value">{{ auth()->user()->roles->pluck('name')->join(', ') }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    <rect x="4" y="20" width="16" height="2" rx="1"></rect>
                </svg>
                Employee ID
            </div>
            <div class="detail-value">EMP-{{ str_pad(auth()->id(), 5, '0', STR_PAD_LEFT) }}</div>
        </div>
    </div>
</div>

</x-filament-panels::page>
