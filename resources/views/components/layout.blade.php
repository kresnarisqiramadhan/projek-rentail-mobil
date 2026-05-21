<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LuxeDrive - Elite Fleet Landing</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary": "#00030c",
                        "on-error-container": "#93000a",
                        "on-primary-fixed-variant": "#474649",
                        "secondary-fixed": "#e2e2e4",
                        "tertiary-container": "#001c42",
                        "surface-container-low": "#f3f3f4",
                        "tertiary-fixed": "#d7e2ff",
                        "surface-bright": "#f9f9f9",
                        "error-container": "#ffdad6",
                        "background": "#f9f9f9",
                        "primary-fixed-dim": "#c8c6c8",
                        "tertiary-fixed-dim": "#abc7ff",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#dfdfe1",
                        "on-secondary-fixed-variant": "#454749",
                        "on-surface": "#1a1c1c",
                        "on-tertiary-fixed-variant": "#00458f",
                        "on-primary-fixed": "#1b1b1d",
                        "on-secondary-fixed": "#1a1c1d",
                        "outline": "#77767b",
                        "on-secondary-container": "#616365",
                        "on-background": "#1a1c1c",
                        "primary-fixed": "#e4e2e4",
                        "on-primary": "#ffffff",
                        "surface-variant": "#e2e2e2",
                        "surface-dim": "#dadada",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#c8c6c8",
                        "outline-variant": "#c7c6ca",
                        "secondary": "#5d5e60",
                        "surface-tint": "#5f5e60",
                        "primary-container": "#1d1d1f",
                        "surface-container": "#eeeeee",
                        "error": "#ba1a1a",
                        "secondary-fixed-dim": "#c6c6c8",
                        "surface-container-highest": "#e2e2e2",
                        "on-tertiary-fixed": "#001b3f",
                        "inverse-surface": "#2f3131",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#2d83f6",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#868587",
                        "primary": "#030304",
                        "inverse-on-surface": "#f0f1f1",
                        "surface": "#f9f9f9",
                        "surface-container-high": "#e8e8e8",
                        "on-surface-variant": "#46464a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "24px",
                        "sm": "12px",
                        "gutter": "24px",
                        "xs": "4px",
                        "xl": "64px",
                        "xxl": "128px",
                        "container-max": "1200px",
                        "unit": "8px",
                        "lg": "40px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Manrope"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "display-xl": ["Manrope"],
                        "display-lg": ["Manrope"],
                        "headline-md": ["Manrope"],
                        "label-md": ["Inter"],
                        "caption": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg": ["40px", { "lineHeight": "1.1", "letterSpacing": "-0.005em", "fontWeight": "600" }],
                        "body-md": ["17px", { "lineHeight": "1.47", "letterSpacing": "0.022em", "fontWeight": "400" }],
                        "body-lg": ["21px", { "lineHeight": "1.38", "letterSpacing": "0.011em", "fontWeight": "400" }],
                        "display-xl": ["80px", { "lineHeight": "1.05", "letterSpacing": "-0.015em", "fontWeight": "700" }],
                        "display-lg": ["56px", { "lineHeight": "1.08", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "headline-md": ["32px", { "lineHeight": "1.15", "letterSpacing": "0em", "fontWeight": "600" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.02em", "fontWeight": "500" }],
                        "caption": ["12px", { "lineHeight": "1.33", "letterSpacing": "0.03em", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #ffffff; }
    </style>
</head>
<body class="text-on-surface antialiased flex flex-col min-h-screen">
    <x-navbar />

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/628111279897" target="_blank" class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-2xl hover:scale-110 active:scale-95 transition-all flex items-center justify-center group" aria-label="Contact via WhatsApp">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966a9.9 9.9 0 0 0-6.98-2.879C5.836 2.16 1.41 6.53 1.406 11.96c-.002 1.674.437 3.313 1.272 4.727L1.625 21.6l5.022-1.446zm12.515-5.551c-.328-.164-1.94-.959-2.241-1.07-.301-.11-.521-.164-.74.164-.219.329-.849 1.07-1.041 1.29-.192.219-.384.246-.712.082-1.321-.661-2.247-1.161-3.155-2.721-.24-.413.24-.383.687-1.278.075-.15.038-.282-.019-.397-.058-.114-.521-1.255-.713-1.72-.188-.454-.379-.393-.521-.4h-.445c-.15 0-.397.056-.604.282-.206.227-.788.771-.788 1.88 0 1.11.808 2.18.92 2.333.111.152 1.588 2.426 3.848 3.399.537.23 1.01.382 1.356.491.54.172 1.03.148 1.418.09.432-.064 1.94-.793 2.214-1.56.274-.767.274-1.422.192-1.56-.082-.138-.301-.219-.63-.383z"/>
        </svg>
        <span class="absolute right-16 bg-zinc-900 text-white text-xs font-medium px-3 py-1.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap shadow-lg">
            Hubungi Kami (0811-1279-897)
        </span>
    </a>
</body>
</html>
