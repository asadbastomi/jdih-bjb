<style>
    :root {
        --hero-bg: linear-gradient(135deg, #0b3b60 0%, #1f5f8b 35%, #0f172a 100%);
        --card-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        --border-soft: #e5edf3;
        --ink-soft: #5f7281;
        --accent: #1f9cf0;
        --accent-2: #1d4ed8;
    }

    body {
        background: #f7f9fb;
    }

    .legal-hero {
        background: var(--hero-bg);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 48px 0 36px;
        color: #f8fafc;
        position: relative;
        overflow: hidden;
    }

    .legal-hero::before,
    .legal-hero::after {
        content: '';
        position: absolute;
        border-radius: 9999px;
        filter: blur(60px);
        opacity: 0.35;
        pointer-events: none;
    }

    .legal-hero::before {
        width: 360px;
        height: 360px;
        background: rgba(56, 189, 248, 0.2);
        top: -120px;
        left: -100px;
    }

    .legal-hero::after {
        width: 280px;
        height: 280px;
        background: rgba(99, 102, 241, 0.22);
        bottom: -90px;
        right: -70px;
    }

    .legal-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #e2e8f0;
    }

    .legal-title {
        margin-top: 16px;
        margin-bottom: 14px;
        font-size: 34px;
        line-height: 1.2;
        color: #f8fafc;
        font-weight: 800;
    }

    .legal-subtitle {
        margin: 0;
        font-size: 15px;
        color: #cbd5e1;
    }

    .legal-chip-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .legal-chip {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 12px;
        color: #e2e8f0;
        font-weight: 600;
    }

    .legal-main {
        padding: 30px 0 40px;
        background: #f7f9fb;
    }

    .legal-main .table-responsive,
    .legal-main .fixed-table-container {
        background: #fff;
        border: 1px solid #e5edf3;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .legal-main table,
    .table-card,
    .fixed-table-container table {
        width: 100%;
        background: #fff;
        margin-bottom: 0;
    }

    .legal-main table thead th,
    .table-card thead th,
    .fixed-table-container thead th,
    .table-hover thead th {
        background: #f8fbfd;
        color: #244253;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .45px;
        border-bottom: 1px solid #e3edf3 !important;
        vertical-align: middle;
        white-space: nowrap;
        padding: 12px 14px;
    }

    .legal-main table tbody td,
    .table-card tbody td,
    .fixed-table-container tbody td,
    .table-hover tbody td {
        border-top: 1px solid #edf3f7;
        vertical-align: middle;
        color: #183541;
        font-size: 13px;
        line-height: 1.45;
        padding: 11px 14px;
    }

    .legal-main table tbody tr:hover,
    .table-card tbody tr:hover,
    .fixed-table-container tbody tr:hover,
    .table-hover tbody tr:hover {
        background: #f8fbff;
    }

    .legal-main table tbody tr.empty td,
    .table-card tbody tr.empty td,
    .fixed-table-container tbody tr.empty td {
        color: #6c7f8a;
        text-align: center;
        padding: 28px 16px;
        background: #fff;
    }

    .legal-main table tfoot td,
    .table-card tfoot td,
    .fixed-table-container tfoot td {
        background: #fff;
        border-top: 1px solid #e5edf3;
        padding: 14px 16px;
    }

    .legal-main table a,
    .table-card a,
    .fixed-table-container a {
        color: #1d4ed8;
        text-decoration: none;
    }

    .legal-main table a:hover,
    .table-card a:hover,
    .fixed-table-container a:hover {
        text-decoration: underline;
    }

    .legal-main table .badge,
    .table-card .badge,
    .fixed-table-container .badge {
        border-radius: 999px;
        padding: 0.35rem 0.6rem;
        font-weight: 700;
        letter-spacing: .2px;
        font-size: 11px;
    }

    .legal-main table .label-table,
    .table-card .label-table,
    .fixed-table-container .label-table {
        font-size: 12px;
    }

    .badge-success,
    .bg-success {
        background: linear-gradient(135deg, #0f766e 0%, #0f9d58 100%) !important;
        color: #fff !important;
    }

    .badge-danger,
    .bg-danger {
        background: linear-gradient(135deg, #9f1239 0%, #dc2626 100%) !important;
        color: #fff !important;
    }

    .badge-info,
    .bg-info {
        background: linear-gradient(135deg, #0f7490 0%, #1f9cf0 100%) !important;
        color: #fff !important;
    }

    .badge-warning,
    .bg-warning {
        background: linear-gradient(135deg, #9a6700 0%, #d97706 100%) !important;
        color: #fff !important;
    }

    .badge-secondary,
    .bg-secondary {
        background: linear-gradient(135deg, #475569 0%, #64748b 100%) !important;
        color: #fff !important;
    }

    .table-card {
        border-radius: 16px;
        border: 1px solid #e5edf3;
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .content-grid-card {
        background: #fff;
        border: 1px solid #e5edf3;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: transform .18s ease, box-shadow .18s ease;
        height: 100%;
    }

    .content-grid-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.09);
    }

    .content-grid-card .card-body {
        padding: 16px 18px 18px;
    }

    .content-grid-card .card-title {
        color: #123247;
        font-size: 18px;
        line-height: 1.35;
        font-weight: 800;
        margin-top: 4px;
        margin-bottom: 0;
    }

    .content-grid-card .card-text,
    .content-grid-card .text-muted {
        color: #6b7f8b !important;
        font-size: 13px;
    }

    .content-grid-card .card-img-top {
        border-bottom: 1px solid #edf3f7;
    }

    .content-grid-card .badge {
        border-radius: 999px;
        font-size: 11px;
    }

    .fixed-table-container table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .fixed-table-container table thead th:first-child,
    .table-card thead th:first-child {
        border-top-left-radius: 16px;
    }

    .fixed-table-container table thead th:last-child,
    .table-card thead th:last-child {
        border-top-right-radius: 16px;
    }

    .fixed-table-container table tbody tr:last-child td:first-child,
    .table-card tbody tr:last-child td:first-child {
        border-bottom-left-radius: 16px;
    }

    .fixed-table-container table tbody tr:last-child td:last-child,
    .table-card tbody tr:last-child td:last-child {
        border-bottom-right-radius: 16px;
    }

    .fixed-table-container .footable-row-detail {
        background: #f8fbfd;
        border-top: 1px solid #e5edf3;
    }

    .fixed-table-container .footable-row-detail-name {
        color: #244253;
        font-weight: 700;
    }

    .fixed-table-container .footable-row-detail-value {
        color: #183541;
    }

    .legal-card {
        background: #fff;
        border: 1px solid #e5edf3;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        margin-bottom: 18px;
    }

    .legal-card-header {
        padding: 14px 18px;
        border-bottom: 1px solid #edf3f7;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .3px;
        text-transform: uppercase;
        color: #244253;
        background: #f8fbfd;
    }

    .legal-card-body {
        padding: 18px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
    }

    .status-badge.active {
        background: linear-gradient(135deg, #0f766e 0%, #0f9d58 100%);
    }

    .status-badge.inactive {
        background: linear-gradient(135deg, #9f1239 0%, #dc2626 100%);
    }

    .metric-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .metric-box {
        border: 1px solid #e5edf3;
        border-radius: 12px;
        padding: 12px;
        background: #fff;
    }

    .metric-label {
        display: block;
        font-size: 11px;
        color: #607986;
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 5px;
        font-weight: 700;
    }

    .metric-value {
        font-size: 20px;
        line-height: 1;
        font-weight: 800;
        color: #123247;
    }

    .meta-table {
        width: 100%;
    }

    .meta-table tr+tr,
    .meta-table tr + tr {
        border-top: 1px solid #edf2f5;
    }

    .meta-table th,
    .meta-table td {
        padding: 12px 0;
        vertical-align: top;
        font-size: 14px;
    }

    .meta-table th {
        width: 240px;
        color: #3f5d6d;
        font-weight: 700;
        padding-right: 14px;
    }

    .meta-table td {
        color: #183541;
    }

    .relation-list {
        margin: 0;
        padding-left: 16px;
    }

    .relation-list li {
        margin-bottom: 6px;
        color: #486370;
    }

    .relation-list a {
        color: var(--accent);
        font-weight: 600;
    }

    .doc-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .doc-actions .btn {
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
    }

    .cover-wrapper {
        border: 1px solid #e5edf3;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        text-align: center;
    }

    .cover-wrapper img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .theme-badge {
        color: #315060;
        display: inline-block;
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 12px;
        margin: 0 8px 8px 0;
        background: #f7fbff;
        border: 1px solid #d8e7f1;
    }

    @media (max-width: 991.98px) {
        .legal-title {
            font-size: 27px;
        }

        .meta-table th {
            width: 185px;
        }
    }

    @media (max-width: 767.98px) {
        .legal-hero {
            padding-top: 24px;
        }

        .legal-title {
            font-size: 23px;
        }

        .metric-grid {
            grid-template-columns: 1fr;
        }

        .meta-table th,
        .meta-table td {
            display: block;
            width: 100%;
            padding: 8px 0;
        }

        .meta-table th {
            padding-bottom: 0;
        }
    }
</style>
