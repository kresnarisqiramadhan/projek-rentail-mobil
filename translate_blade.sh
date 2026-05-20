#!/bin/bash

# Pastikan di root proyek Laravel
cd "$(dirname "$0")"

# Cek apakah id.json ada
if [ ! -f "lang/id.json" ]; then
    echo "File lang/id.json tidak ditemukan. Harap buat terlebih dahulu."
    exit 1
fi

# Cek jq tersedia
if ! command -v jq &> /dev/null; then
    echo "jq tidak terinstall. Install dengan: sudo apt install jq"
    exit 1
fi

echo "Memulai penggantian string di semua file Blade..."

# Baca semua key dari id.json dan ganti dalam file blade
jq -r 'keys[]' lang/id.json | while read -r key; do
    # Escape karakter khusus untuk sed (/, &, \, dan spasi)
    escaped_key=$(printf '%s\n' "$key" | sed -e 's/[\/&]/\\&/g' -e 's/\\/\\\\/g')
    # Escape juga untuk replacement string (tambahkan backslash untuk & dan \)
    replacement="{{ __('$key') }}"
    escaped_replacement=$(printf '%s\n' "$replacement" | sed -e 's/[\/&]/\\&/g' -e 's/\\/\\\\/g')

    # Ganti pola: >teks<
    find resources/views -name "*.blade.php" -exec sed -i "s|>$escaped_key<|>$escaped_replacement<|g" {} \;
    # Ganti placeholder="teks"
    find resources/views -name "*.blade.php" -exec sed -i "s|placeholder=\"$escaped_key\"|placeholder=\"$escaped_replacement\"|g" {} \;
    # Ganti title="teks"
    find resources/views -name "*.blade.php" -exec sed -i "s|title=\"$escaped_key\"|title=\"$escaped_replacement\"|g" {} \;
    # Ganti aria-label="teks"
    find resources/views -name "*.blade.php" -exec sed -i "s|aria-label=\"$escaped_key\"|aria-label=\"$escaped_replacement\"|g" {} \;
    # Ganti value="teks" (untuk input button)
    find resources/views -name "*.blade.php" -exec sed -i "s|value=\"$escaped_key\"|value=\"$escaped_replacement\"|g" {} \;
    # Ganti label="teks" (jika ada)
    find resources/views -name "*.blade.php" -exec sed -i "s|label=\"$escaped_key\"|label=\"$escaped_replacement\"|g" {} \;
done

echo "Selesai. Periksa file di resources/views."
