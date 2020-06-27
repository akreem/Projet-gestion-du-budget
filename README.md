# Budget & Procurement Management System

A Symfony web application designed to manage the budget execution workflow of an aviation school, from annual budget planning to supplier quotation comparison, purchase orders, commitments, meeting minutes, payment orders, and printable PDF documents.

This project was built as a final-year academic project and models a real administrative process: creating budget lines, preparing quote requests, collecting supplier offers, selecting the best articles or suppliers, and generating the official documents needed to follow and justify spending.

## Project Highlights

- End-to-end budget management workflow for an institutional environment
- Quote request and supplier offer management
- Automatic recap and comparison tables for purchasing decisions
- Purchase order generation from selected quote lines or suppliers
- Budget commitments with automatic updates to paid and unpaid totals
- PDF export for administrative documents using wkhtmltopdf through KnpSnappy
- User authentication, registration, account editing, and password update
- Responsive back-office interface based on Bootstrap and SB Admin 2

## Main Features

### Budget Planning

- Create yearly budgets with multiple budget headings.
- Track total budget, paid amount, and unpaid committed amount.
- Edit budget data and print budget summaries as PDF files.

### Quote Request Workflow

- Create quote request templates with product lines, quantities, deadlines, year, and budget heading.
- Generate supplier quotes from an existing request template.
- Store supplier contact information, unit prices, VAT, totals before tax, VAT amount, and totals including tax.
- View, edit, delete, and print quote request documents.

### Supplier Comparison and Selection

- Build comparison tables from supplier quotes.
- Select winning offers either by individual article or by supplier.
- Prevent duplicate selections and protect the workflow from selecting more items than requested.
- Generate recap tables by article, by supplier, or grouped by the same supplier.

### Purchase Orders

- Create purchase orders automatically from selected quote lines.
- Group order lines by supplier when needed.
- Export purchase orders and supplier-specific purchase orders as PDF documents.

### Commitments and Payments

- Register budget commitments against budget headings.
- Automatically update committed unpaid totals on the related budget and heading.
- Generate commitment PDFs.
- Create and export payment orders.

### Administrative Documents

- Create minutes and related line items.
- Generate PDF versions of minutes, budget summaries, quote requests, recap tables, purchase orders, commitments, and payment orders.

## Tech Stack

- **Backend:** PHP 7.1+, Symfony 4.4
- **Database:** Doctrine ORM with Doctrine Migrations
- **Templating:** Twig
- **Forms and Validation:** Symfony Form and Validator components
- **Security:** Symfony Security with bcrypt password hashing
- **PDF generation:** KnpSnappyBundle and wkhtmltopdf
- **Frontend:** Bootstrap, SB Admin 2, jQuery, DataTables, Chart.js, Font Awesome

## Application Structure

```text
src/
  Controller/      HTTP routes and business workflows
  Entity/          Doctrine domain entities
  Form/            Symfony form types
  Repository/      Custom Doctrine repositories
  Migrations/      Database schema migrations

templates/         Twig views and PDF templates
public/            CSS, JavaScript, images, and vendor assets
config/            Symfony, Doctrine, security, routing, and PDF configuration
tests/             PHPUnit bootstrap
```

## Key Domain Entities

- `Budget` and `Rubrique`: yearly budgets and budget headings
- `DevisVierge` and `LigneDevisVierge`: quote request templates and requested articles
- `Devis` and `LigneDevis`: supplier quotes and quoted article prices
- `TableauRecap` and `LigneRecap`: comparison tables and selected offers
- `BonCommande` and `LigneCommande`: purchase orders and order lines
- `Engagement`: budget commitments
- `Pv` and `Lignepv`: meeting minutes
- `Ordrepayement`: payment orders
- `User`: authenticated application users

## Getting Started

### Prerequisites

- PHP 7.1.3 or newer compatible with Symfony 4.4
- Composer
- MySQL or MariaDB
- Symfony CLI, optional but recommended
- wkhtmltopdf installed locally for PDF generation

On Windows, the current PDF configuration expects:

```text
C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe
C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage.exe
```

If wkhtmltopdf is installed elsewhere, update `config/packages/knp_snappy.yaml`.

### Installation

1. Clone the repository.

```bash
git clone <repository-url>
cd Projet-gestion-du-budget
```

2. Install PHP dependencies.

```bash
composer install
```

3. Configure the database connection in `.env`.

```dotenv
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

4. Create the database and run migrations.

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Start the application.

```bash
symfony server:start
```

Or use PHP's built-in server:

```bash
php -S 127.0.0.1:8000 -t public
```

Then open:

```text
http://127.0.0.1:8000
```

The root route redirects to the application menu.

## Authentication

The application uses Symfony form login. New users can register through `/signup`, then authenticate through `/login`. All main application routes require an authenticated user.

## Useful Routes

- `/menu`: main dashboard menu
- `/afficherbudget`: budget list
- `/budget/`: create a budget
- `/devis_vierge`: create a quote request template
- `/liste_DevisVierge`: quote request list
- `/devis`: supplier quote list
- `/AfficherTabsRecap`: recap/comparison table list
- `/boncommandes`: purchase order list
- `/AfficherEngagement`: commitment list
- `/afficherpv`: minutes list
- `/ordrepayement`: payment order list

## Why This Project Matters

This application demonstrates the ability to translate a complex administrative purchasing process into a structured web system. It combines domain modeling, relational data design, form-heavy workflows, authentication, server-rendered interfaces, and document generation. The result is a practical back-office tool that supports traceability, purchasing decisions, and budget control.

## Future Improvements

- Add automated functional and integration tests
- Add role-based permissions for administrators and standard users
- Improve dashboard analytics for budget consumption
- Add search and filtering across budgets, suppliers, and documents
- Containerize the application with Docker for easier deployment
- Modernize the frontend asset pipeline

## License

This project is currently marked as proprietary in `composer.json`.

