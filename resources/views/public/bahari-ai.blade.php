<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Bahari AI - JDIH Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bahari AI - Banjarbaru Hukum & Regulasi Intelligence" name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/landing.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/headline.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .bahari-hero {
            background: linear-gradient(135deg, #0b3b60 0%, #1f5f8b 35%, #0f172a 100%);
            color: #f8fafc;
            padding: 96px 0 72px;
            position: relative;
            overflow: hidden;
        }

        .bahari-hero::before,
        .bahari-hero::after {
            content: '';
            position: absolute;
            border-radius: 9999px;
            filter: blur(60px);
            opacity: 0.35;
        }

        .bahari-hero::before {
            width: 380px;
            height: 380px;
            background: #38bdf8;
            top: -120px;
            left: -100px;
        }

        .bahari-hero::after {
            width: 320px;
            height: 320px;
            background: #818cf8;
            bottom: -80px;
            right: -60px;
        }

        .bahari-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 9999px;
            color: #e2e8f0;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.4px;
        }

        .bahari-cta {
            display: inline-flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-primary-strong {
            background: linear-gradient(135deg, #1f9cf0 0%, #2563eb 50%, #4338ca 100%);
            color: #fff;
            border: none;
            padding: 14px 22px;
            border-radius: 14px;
            font-weight: 700;
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.35);
        }

        .btn-primary-strong:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 45px rgba(37, 99, 235, 0.45);
            color: #fff;
        }

        .btn-ghost {
            background: rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 14px 20px;
            border-radius: 14px;
            font-weight: 700;
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .bahari-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.1);
            height: 100%;
            border: 1px solid #e2e8f0;
        }

        .bahari-card h5 {
            color: #0f172a;
            margin-bottom: 10px;
        }

        .bahari-card p {
            color: #475569;
            line-height: 1.65;
        }

        .code-block {
            background: #0f172a;
            color: #e2e8f0;
            border-radius: 14px;
            padding: 18px;
            font-family: "SFMono-Regular", Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 13px;
            border: 1px solid #1e293b;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.35);
            overflow-x: auto;
        }

        .feature-list li {
            margin-bottom: 10px;
            color: #0f172a;
        }

          /* Embed the chat widget inline on this page */
          .chat-embed {
              margin-top: 32px;
          }

          .chat-embed #chat-widget {
              position: static;
          }

          .chat-embed .chat-toggle-btn,
          .chat-embed .chat-badge {
              display: none !important;
          }

          .chat-embed .chat-window {
              position: static !important;
              width: 100% !important;
              max-width: 100% !important;
              max-height: none !important;
              border-radius: 18px;
              box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
              opacity: 1 !important;
              visibility: visible !important;
              transform: none !important;
              pointer-events: auto !important;
              border: 1px solid rgba(31, 159, 240, 0.12);
          }

          .chat-embed .chat-messages {
              max-height: 420px;
          }

          .chat-embed .chat-window.active {
              display: flex !important;
          }
    </style>
</head>

<body>
    @include('public.header')

    <section class="bahari-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="bahari-badge mb-3">
                        <span class="mdi mdi-robot"></span>
                        <span>Bahari AI · Banjarbaru Hukum & Regulasi Intelligence</span>
                    </div>
                    <h1 class="display-4 font-weight-bold mb-3">Asisten hukum digital untuk Kota Banjarbaru</h1>
                    <p class="lead mb-4" style="max-width: 720px; color: #e2e8f0;">
                        Bahari AI membantu Anda menemukan regulasi (KUHP, Perda, Perwali, dan produk hukum lainnya),
                        menyajikan abstrak, metadata, serta tautan unduhan dengan format yang konsisten.
                    </p>
                    <div class="bahari-cta">
                        <a href="#bahari-chat" class="btn btn-primary-strong">Mulai chat Bahari AI</a>
                        <a href="#json-format" class="btn btn-ghost">Lihat format respons</a>
                        <span class="bahari-badge">Akses langsung: /bahari-ai</span>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="bahari-card">
                        <h5 class="mb-2">Siap pakai</h5>
                        <p class="mb-2">Gunakan tombol di atas untuk melompat ke chat yang sudah ditanam di halaman ini.</p>
                        <p class="mb-0">Bahari AI memprioritaskan jawaban terstruktur dan akan menyarankan penelusuran
                            lebih lanjut jika data belum tersedia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="bahari-features" style="background:#f8fafc;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="bahari-card">
                        <h5>Pencarian regulasi</h5>
                        <p>Telusuri KUHP, Perda Banjarbaru, Perwali, keputusan, dan produk hukum lainnya dengan kata
                            kunci atau nomor.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="bahari-card">
                        <h5>Abstrak dan metadata</h5>
                        <p>Dapatkan judul, nomor, tahun, topik singkat, abstrak, serta tautan berkas unduhan ketika
                            tersedia.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="bahari-card">
                        <h5>Jawaban berhati-hati</h5>
                        <p>Jika data belum pasti, Bahari AI akan menandai dengan "perlu ditelusuri lebih lanjut" tanpa
                            beropini.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="bahari-chat" style="background:#f8fafc;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-3">Coba Bahari AI langsung</h3>
                    <p class="text-muted mb-3">Chat ditanam langsung di halaman ini, tanpa pop-up.</p>
                    <div class="chat-embed">
                        @include('public.chat-widget')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="json-format">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="mb-3">Format respons standar</h3>
                    <p class="text-muted">Bahari AI menjaga struktur JSON berikut. Nilai yang belum ada diisi
                        <code>null</code>.</p>
                    <div class="code-block">
                        <pre>{
"status": true,
"response": {
  "penjelasan": "...",
  "regulasi": {
    "judul": "...",
    "nomor": "...",
    "tahun": "...",
    "tentang": "...",
    "abstrak": "...",
    "file_url": "..."
  },
  "pasal": {
    "nomor": {
      "ayat": {
        "isi": "...",
        "penjelasan": "...",
        "anotasi": "..."
      }
    }
  }
}
}</pre>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <h3 class="mb-3">Panduan cepat</h3>
                    <ul class="feature-list pl-3">
                        <li>Mintalah regulasi tertentu beserta abstrak dan tautan unduhan.</li>
                        <li>Gunakan nomor atau kata kunci, misalnya "Perda ketenteraman dan ketertiban umum".</li>
                        <li>Jika informasi tidak ditemukan, Bahari AI akan mengembalikan <code>null</code> atau
                            mencantumkan "perlu ditelusuri lebih lanjut".</li>
                        <li>Hindari permintaan opini; Bahari AI hanya menyajikan data dan status.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('public.footer')

    <script>
        (function() {
            const chatWindow = document.getElementById('chat-window');
            if (chatWindow) {
                chatWindow.classList.add('active');
                const chatInput = document.getElementById('chat-input');
                if (chatInput) {
                    chatInput.focus();
                }
            }
        })();
    </script>
</body>

</html>
