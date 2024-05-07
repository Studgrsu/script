#!/bin/bash

if [ $# -lt 2 ]; then
  echo "Использование: $0 <исходный_файл> <новое_расширение>"
  exit 1
fi

original_file="$1"
new_extension="$2"

base_name="${original_file%.*}"

if [[ "$original_file" == "$base_name" ]]; then
  new_file="${base_name}.${new_extension}"
else
  new_file="${base_name}.${new_extension}"
fi

mv "$original_file" "$new_file"

echo "Файл '$original_file' переименован в '$new_file'"
