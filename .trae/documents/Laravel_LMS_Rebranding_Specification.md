# Laravel LMS Rebranding & Cleanup Specification

## 1. Project Overview

This document outlines the comprehensive rebranding and cleanup process for transforming the existing Laravel LMS project UNDP with complete removal of third-party integrations and payment gateways.

**Current State:**

* Application Name: SkillGro

* Primary Color: #5751E1 (Purple)

* Multiple payment gateway integrations

* Various third-party service dependencies

**Target State:**

* Application Name: UNDO

* Primary Color: Blue (#007bff or custom blue)

* No payment gateway integrations

* Clean codebase without external service dependencies

## 2. Core Changes Required

### 2.1 Application Branding Changes

#### Configuration Files

| File Path         | Current Value                           | New Value                           | Description                    |
| ----------------- | --------------------------------------- | ----------------------------------- | ------------------------------ |
| `/config/app.php` | `'name' => env('APP_NAME', 'SkillGro')` | `'name' => env('APP_NAME', 'UNDO')` | Application name configuration |
| `/.env.example`   | `APP_NAME=Laravel`                      | `APP_NAME=UNDO`                     | Environment example file       |
| `/.env.example`   | `DB_DATABASE=skillgro`                  | `DB_DATABASE=undo_lms`              | Database name                  |
| `/.env.example`   | `APP_URL=http://skillgro.test/`         | `APP_URL=http://undo.test/`         | Application URL                |

#### Frontend Assets

| File Path                                            | Change Required               | Description                        |
| ---------------------------------------------------- | ----------------------------- | ---------------------------------- |
| `/public/frontend/css/flaticon-skillgro.css`         | Rename to `flaticon-undo.css` | Custom icon font file              |
| `/resources/views/frontend/layouts/styles.blade.php` | Update CSS reference          | Change flaticon-skillgro reference |

### 2.2 Color Scheme Changes

#### Primary Color Updates

| File Path                                  | Current Color        | New Color            | Element               |
| ------------------------------------------ | -------------------- | -------------------- | --------------------- |
| `/public/frontend/scss/utils/_colors.scss` | `primary: #5751E1`   | `primary: #007bff`   | Theme primary color   |
| `/public/frontend/scss/utils/_colors.scss` | `secondary: #FFC224` | `secondary: #6c757d` | Theme secondary color |

#### CSS Variable Updates

```scss
// Update in _colors.scss
$colors: (
    theme: (
        primary: #007bff,        // Changed from #5751E1
        secondary: #6c757d,      // Changed from #FFC224
    ),
    common: (
        color-blue: #007bff,     // Updated blue variant
        color-blue-2: #0056b3,   // Darker blue variant
    )
);
```

### 2.3 Payment Gateway Removal

#### Composer Dependencies to Remove

```json
// Remove from composer.json
"alphaolomi/laravel-azampay": "^1.0",
"braintree/braintree_php": "^6.26",
"mollie/laravel-mollie": "^2.25",
"razorpay/razorpay": "^2.8",
"srmklive/paypal": "^3.0",
"stripe/stripe-php": "^13.2",
"xendit/xendit-php": "^7.0"
```

#### Modules to Remove/Disable

| Module Path               | Action            | Description                 |
| ------------------------- | ----------------- | --------------------------- |
| `/Modules/BasicPayment/`  | Remove completely | Core payment module         |
| `/Modules/BkashPG/`       | Remove completely | Bkash payment gateway       |
| `/Modules/MercadoPagoPG/` | Remove completely | MercadoPago payment gateway |

#### Configuration Files to Clean

| File Path                        | Changes Required  |
| -------------------------------- | ----------------- |
| `/config/paypal.php`             | Remove file       |
| `/config/azampay.php`            | Remove file       |
| Any payment-related config files | Remove completely |

### 2.4 Third-Party Service Cleanup

#### External Links to Remove

| Location                   | Type                      | Action                                 |
| -------------------------- | ------------------------- | -------------------------------------- |
| FontAwesome metadata files | External sponsor URLs     | Clean or replace with local references |
| Any Codecanyon references  | License/attribution links | Remove completely                      |
| External CDN links         | Third-party assets        | Replace with local assets              |

## 3. Implementation Steps

### Phase 1: Environment & Configuration

1. Update `.env.example` with new branding
2. Modify `config/app.php` application name
3. Update database configuration references
4. Clean environment variables related to payment gateways

### Phase 2: Payment Gateway Removal

1. Remove payment gateway dependencies from `composer.json`
2. Delete payment-related modules:

   * `Modules/BasicPayment/`

   * `Modules/BkashPG/`

   * `Modules/MercadoPagoPG/`
3. Remove payment configuration files
4. Clean up routes related to payments
5. Remove payment-related database migrations

### Phase 3: Frontend Rebranding

1. Update color scheme in SCSS files
2. Rename and update icon font files
3. Replace logo and branding assets
4. Update meta tags and page titles
5. Modify navigation and UI text references

### Phase 4: Backend Cleanup

1. Remove payment-related controllers and services
2. Clean up admin panel payment sections
3. Update settings and configuration pages
4. Remove payment-related database tables

### Phase 5: Asset Compilation

1. Recompile SCSS to CSS with new colors
2. Update and rebuild frontend assets
3. Clear application caches
4. Test all frontend components

## 4. Files Requiring Manual Review

### Critical Files to Check

* All Blade templates for hardcoded "SkillGro" references

* JavaScript files for branding references

* Language files (`/lang/`) for text updates

* Database seeders for default data

* Email templates for branding

### Search Patterns

Use these patterns to find remaining references:

```bash
# Search for SkillGro references
grep -r "SkillGro" --exclude-dir=vendor .
grep -r "skillgro" --exclude-dir=vendor .

# Search for payment gateway references
grep -r "stripe\|paypal\|razorpay" --exclude-dir=vendor .

# Search for external URLs
grep -r "http://\|https://" --exclude-dir=vendor . | grep -v localhost
```

## 5. Database Changes

### Tables to Remove

* `payment_gateways`

* `payment_transactions`

* `stripe_*` tables

* `paypal_*` tables

* Any payment-related tables

### Settings to Update

```sql
-- Update application settings
UPDATE settings SET value = 'UNDO' WHERE key = 'app_name';
UPDATE settings SET value = '#007bff' WHERE key = 'primary_color';

-- Remove payment gateway settings
DELETE FROM settings WHERE key LIKE '%stripe%';
DELETE FROM settings WHERE key LIKE '%paypal%';
DELETE FROM settings WHERE key LIKE '%razorpay%';
```

## 6. Testing Checklist

### Frontend Testing

* [ ] All pages load without payment gateway errors

* [ ] Color scheme is consistently blue

* [ ] No "SkillGro" references visible

* [ ] Icons and fonts load correctly

* [ ] Responsive design works properly

### Backend Testing

* [ ] Admin panel accessible without payment errors

* [ ] Settings pages work correctly

* [ ] No payment-related menu items

* [ ] Database operations function normally

* [ ] User registration/login works

### Performance Testing

* [ ] Page load times improved (no external calls)

* [ ] Asset loading optimized

* [ ] No 404 errors for removed resources

## 7. Post-Implementation Notes

### Security Considerations

* Remove any API keys from environment files

* Clean up any payment webhook endpoints

* Ensure no sensitive payment data remains

### Maintenance

* Update documentation to reflect changes

* Create new deployment scripts without payment dependencies

* Set up monitoring for the cleaned application

### Future Considerations

* If payment functionality needed later

