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
</body>
</html>
