# 🛠️ Troubleshooting: Recursos no se visualizan en lecciones

## Problema
Los alumnos reportan que algunos archivos (PDFs, videos, imágenes) no se visualizan en el contenedor de la página de lecciones.

## Causas Comunes

### 1. **Symlink de Storage Roto** ⚠️
El symlink `public/storage` → `storage/app/public` puede romperse después de:
- Deploy en producción
- Cambios en permisos
- Actualización del servidor

**Síntoma:** Error 404 al intentar cargar archivos

**Solución:**
```bash
php artisan storage:link --force
```

### 2. **Caché de Laravel Desactualizado** 🔄
Laravel cachea rutas y configuraciones. Si el symlink se crea después del caché, puede usar rutas incorrectas.

**Solución:**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan storage:link --force
php artisan config:cache
php artisan route:cache
```

### 3. **Permisos Incorrectos** 🔐
El servidor web (nginx/apache) no puede leer los archivos.

**Solución:**
```bash
chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

### 4. **file_type NULL en Base de Datos** 📊
Recursos creados antes de agregar la columna `file_type` tienen valores NULL.

**Diagnóstico:**
```bash
php artisan recursos:diagnose
```

**Solución:**
```bash
# Simular cambios
php artisan recursos:fix-types --dry-run

# Aplicar cambios
php artisan recursos:fix-types
```

## Comandos de Diagnóstico

### `php artisan recursos:diagnose`
Verifica:
- ✅ Estado del symlink storage
- ✅ Recursos sin file_type
- ✅ Archivos físicos faltantes
- ✅ Permisos de storage

### `php artisan recursos:fix-types`
Actualiza `file_type` NULL detectando desde extensión del archivo.

Opciones:
- `--dry-run`: Simula cambios sin guardar

## Deploy en Producción

El script `deploy_production.sh` ya incluye todos los pasos necesarios:

```bash
./deploy_production.sh
```

**Orden de ejecución:**
1. Instalar dependencias
2. Compilar assets
3. Migrar base de datos
4. **Limpiar cachés**
5. **Crear symlink storage**
6. Cachear configuración
7. Optimizar framework

## Prevención

### En cada deploy:
```bash
php artisan config:clear
php artisan storage:link --force
php artisan config:cache
```

### Verificar después de deploy:
```bash
php artisan recursos:diagnose
```

## Notas Técnicas

### Accessor en Modelo Recurso
El modelo tiene un accessor que detecta `file_type` automáticamente desde la extensión:

```php
public function getFileTypeAttribute($value): ?string
{
    if ($value) return $value;
    
    $extension = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
    
    return match ($extension) {
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp' => 'image',
        'mp4', 'mov', 'avi', 'mkv', 'webm', 'm4v' => 'video',
        'mp3', 'wav', 'ogg', 'm4a', 'aac', 'flac' => 'audio',
        'pdf' => 'pdf',
        default => 'other',
    };
}
```

Esto significa que **aunque `file_type` sea NULL en DB, el modelo lo detecta automáticamente**. Sin embargo, es mejor persistirlo en DB para performance.

### Vista de Lección
La vista `resources/views/student/leccion/show.blade.php` filtra recursos visibles:

```php
$viewableTypes = ['video', 'image', 'pdf', 'audio'];
foreach($leccion->recursos as $recurso) {
    if (in_array($recurso->file_type, $viewableTypes)) {
        // Agregar a galería
    }
}
```

El accessor funciona correctamente aquí, por lo que el problema NO es el `file_type` NULL, sino el **symlink o permisos**.
