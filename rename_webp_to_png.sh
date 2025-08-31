#!/bin/bash

# Скрипт для переименования .webp файлов в .png в папке games
# Путь к папке с играми
GAMES_DIR="/Users/nikita/casinoEvgeniy/Casino/public/assets/images/games"

# Проверяем, существует ли папка
if [ ! -d "$GAMES_DIR" ]; then
    echo "Ошибка: Папка $GAMES_DIR не найдена!"
    exit 1
fi

echo "Начинаем переименование .webp файлов в .png в папке: $GAMES_DIR"
echo "----------------------------------------"

# Счетчик переименованных файлов
count=0

# Переходим в папку с играми
cd "$GAMES_DIR" || exit 1

# Находим все .webp файлы и переименовываем их
for file in *.webp; do
    # Проверяем, существует ли файл (на случай если нет .webp файлов)
    if [ -f "$file" ]; then
        # Получаем имя файла без расширения
        filename="${file%.*}"
        # Новое имя с расширением .png
        newname="${filename}.png"

        # Проверяем, не существует ли уже файл с таким именем
        if [ -f "$newname" ]; then
            echo "⚠️  Пропускаем $file - файл $newname уже существует"
        else
            # Переименовываем файл
            mv "$file" "$newname"
            echo "✅ $file → $newname"
            ((count++))
        fi
    fi
done

echo "----------------------------------------"
echo "Переименование завершено! Обработано файлов: $count"

# Показываем все .png файлы для проверки
echo ""
echo "Все .png файлы в папке:"
ls -la *.png 2>/dev/null || echo "Файлы .png не найдены"