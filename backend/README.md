# Backend（Laravel）

此目錄包含專案的 Laravel 後端程式碼與相關設定。本 README 說明開發環境設定、啟動流程，以及如何執行自動化測試（unit / feature）。

## 目標

- 建立並執行後端應用
- 提供資料庫遷移與種子（seed）說明
- 明確說明如何執行自動化測試並在 CI 中運行

## 前置需求

- PHP 版本：建議 PHP 8.1+（依 `composer.json` 與系統需求調整）
- Composer
- (選用) Docker / docker-compose（專案根目錄有 `docker-compose.yml`）
- 資料庫：SQLite、MySQL 或 Postgres（請檢查 `config/database.php`）

## 快速安裝（本機開發）

在專案 `backend/` 目錄下執行：

```powershell
# 安裝 PHP 套件
composer install

# 複製環境範本並產生 APP key
copy .env.example .env
php artisan key:generate

# 執行遷移並（選擇性）填充測試資料
php artisan migrate --seed

# 啟動開發 server（或使用 Docker）
php artisan serve --host=127.0.0.1 --port=8000
```

如果使用 Docker：在專案根目錄執行 `docker-compose up -d`，然後：

```powershell
docker-compose exec backend bash
# 進入容器後可執行上面相同的 artisan / composer 命令
```

## 環境變數與資料庫

- 編輯 `.env` 設定資料庫連線。範例（SQLite）：

```ini
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```

若使用 MySQL / Postgres，請設定相對應的 `DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD`。

## 測試（重要）

此專案使用 Laravel 的測試工具與 phpunit。測試檔位於 `tests/` 中（Unit 與 Feature）。下列為常見的測試執行方式：

### 使用 Artisan（建議）

```powershell
# 執行整套測試（會跑 phpunit）
php artisan test

# 顯示更詳細的輸出（視專案而定）
php artisan test --parallel --testsuite=Feature
```

### 使用 phpunit（直接執行）

```powershell
# Windows: 使用 vendor 提供的執行檔
vendor\bin\phpunit.bat

# 或 (Linux/macOS 或 WSL)
./vendor/bin/phpunit

# 執行單一測試類或含特定範例的測試
vendor\bin\phpunit.bat --filter MyTestClass
```

### 在 Docker 容器中執行測試

```powershell
docker-compose exec backend php artisan test
```

測試注意事項：

- 測試執行時會使用測試資料庫（請確認 `phpunit.xml` 中的設定，或在測試前建立測試用的 sqlite 檔案）。
- 若你需要查看程式碼覆蓋率，需要安裝並啟用 Xdebug 或 PCOV，並使用 phpunit 的 `--coverage` 選項。

## 常用測試指令小結

```powershell
# 執行所有測試
php artisan test

# 使用 phpunit（Windows）
vendor\bin\phpunit.bat

# 執行單一測試檔或範例
php artisan test --filter=ExampleTest
```

## CI / GitHub Actions 範例（簡短）

在 CI 中通常會做：安裝依賴、建立 `.env`、執行遷移、執行測試。下面為簡化示意（放到 `.github/workflows/ci.yml`）：

```yaml
name: CI
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
      - run: composer install --prefer-dist --no-progress --no-suggest
      - run: cp .env.example .env
      - run: php artisan key:generate
      - run: php artisan migrate --env=testing --no-interaction
      - run: php artisan test --no-interaction --verbose
```

(依專案 CI 需求可再調整)

## 偵錯與常見問題

- 若測試找不到資料庫或連線錯誤，請檢查 `phpunit.xml` 與 `.env.testing` 的 DB 設定。
- 如果 migration 或 seeder 失敗，先在本機執行 `php artisan migrate:fresh --seed` 以清空並重建資料表。

## 參考與聯絡

- 參考：Laravel 官方文件（[https://laravel.com/docs](https://laravel.com/docs)）
- 若需幫忙，請建立 issue 或直接聯絡專案維護者。

---

最後更新：2025-11-02
