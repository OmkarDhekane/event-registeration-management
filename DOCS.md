# Event Registration and Management System

## Project status

Working local application. The Laravel backend, event and registration database schema, public and administrator interfaces, responsive assets, seed data, authentication, and feature tests are implemented. The included local development environment uses SQLite for a zero-configuration start; the application remains configured for MySQL through `.env.example`.

This repository will contain a small, responsive event registration and management application. It is an independent portfolio project.

## Project overview

The Event Registration and Management System is a web application whose home page is the public event listing. When visitors open the application, they immediately see upcoming published events; there is no separate landing page or other public content section.

Visitors can:

- Browse published events.
- Search events by keyword.
- Filter events by format.
- View complete event details.
- Submit an event registration form.

An administrator can:

- Sign in to a protected staff area.
- Create a new event.
- Publish the event to the public event listing.

The project is intentionally small. Its purpose is to demonstrate a complete, maintainable web application using semantic HTML, responsive CSS, JavaScript, PHP, Laravel MVC, and MySQL.

## Why this project should exist

Event information should be easy to find and use on any device. Visitors need a straightforward way to discover an event, understand when and where it takes place, and register without navigating a complicated interface.

Event administrators also need a controlled way to create event information and make it publicly available without modifying source code.

This project addresses those needs with one focused public workflow and one small administrative workflow.

## Problem statement

Visitors may struggle to find relevant events when listings are difficult to search, do not work well on mobile devices, or provide incomplete details. Registration forms can also create barriers when they lack clear labels, keyboard support, or understandable validation messages.

The application will provide a responsive public event listing with keyword search, format filtering, event detail pages, and a simple registration form. A protected administrator area will allow an authorized user to create and publish events.

## Project goals

1. Allow visitors to find published events quickly.
2. Allow visitors to view the information needed to decide whether to attend.
3. Provide a simple and accessible event registration form.
4. Allow an administrator to create and publish events.
5. Demonstrate PHP and Laravel MVC with a MySQL database.
6. Demonstrate semantic HTML, responsive CSS, and progressively enhanced JavaScript.
7. Apply a small set of important accessibility practices throughout the application.

## Scope

### Visitor features

- Open the application home page and immediately view a public list of upcoming published events.
- Search published events by words in the title or description.
- Filter published events by format: in person, online, or hybrid.
- View an individual event detail page.
- Submit a registration form containing a name and email address.
- Receive clear validation feedback or a registration confirmation.

### Administrator features

- Sign in using an administrator account.
- View a small dashboard containing unpublished events.
- Create an event using a protected form.
- Publish a created event to the public listing.
- Sign out.

## Out of scope

The initial application will not include:

- Editing or deleting events.
- Cancelling or archiving events.
- Registration management or attendee exports.
- Registration confirmation emails.
- Public visitor accounts.
- Multiple administrator roles.
- Payments, waitlists, or calendar integrations.
- Content unrelated to events.
- Image uploads.
- A general-purpose content management system.

These exclusions keep the project focused on the requested event workflow.

## Technology stack

### Front end

- Semantic HTML5.
- Mobile-first CSS3.
- Vanilla JavaScript for optional interface enhancements.
- Laravel Blade templates for server-rendered pages.

### Back end

- PHP.
- Laravel using Model-View-Controller architecture.
- Laravel authentication and authorization for the administrator area.
- Server-side form validation.

### Data and development tools

- MySQL.
- Laravel migrations and seeders.
- Git and GitHub.
- PHPUnit and Laravel feature tests.

## Project structure

```text
event-registration-system/
|-- app/
|   |-- Http/
|   |   |-- Controllers/
|   |   |   |-- Public/
|   |   |   |   |-- EventController.php
|   |   |   |   `-- RegistrationController.php
|   |   |   `-- Admin/
|   |   |       |-- AuthController.php
|   |   |       `-- EventController.php
|   |   `-- Requests/
|   |       |-- Public/
|   |       |   `-- StoreRegistrationRequest.php
|   |       `-- Admin/
|   |           |-- LoginRequest.php
|   |           `-- StoreEventRequest.php
|   `-- Models/
|       |-- User.php
|       |-- Event.php
|       `-- Registration.php
|-- database/
|   |-- factories/
|   |   |-- UserFactory.php
|   |   |-- EventFactory.php
|   |   `-- RegistrationFactory.php
|   |-- migrations/
|   |   |-- 0001_01_01_000000_create_users_table.php
|   |   |-- 2026_10_20_000001_create_events_table.php
|   |   `-- 2026_10_20_000002_create_registrations_table.php
|   `-- seeders/
|       `-- DatabaseSeeder.php
|-- resources/
|   |-- css/
|   |   `-- app.css
|   |-- js/
|   |   `-- app.js
|   `-- views/
|       |-- layouts/
|       |   |-- public.blade.php
|       |   `-- admin.blade.php
|       |-- components/
|       |   `-- error-summary.blade.php
|       |-- public/events/
|       |   |-- index.blade.php
|       |   |-- show.blade.php
|       |   |-- register.blade.php
|       |   `-- confirmation.blade.php
|       `-- admin/
|           |-- auth/
|           |   `-- login.blade.php
|           `-- events/
|               |-- index.blade.php
|               |-- create.blade.php
|               `-- confirm-publish.blade.php
|-- routes/
|   |-- web.php
|   |-- public.php
|   `-- admin.php
|-- tests/Feature/
|   |-- Public/
|   |   |-- EventDiscoveryTest.php
|   |   `-- EventRegistrationTest.php
|   `-- Admin/
|       `-- EventManagementTest.php
|-- .env.example
|-- artisan
|-- composer.json
|-- package.json
|-- phpunit.xml
|-- vite.config.js
`-- README.md
```

The public and administrator modules share the `Event` model while keeping their controllers, requests, routes, and views separate. Standard Laravel framework directories such as `bootstrap/`, `config/`, `public/`, and `storage/` remain at the project root but are omitted from the tree above for readability.

## Local setup

### Prerequisites

- PHP 8.3 or newer.
- Composer.
- Node.js 22 or newer and npm.
- SQLite for the quickest local start, or MySQL for the originally planned database environment.

### Setup steps

1. Copy `.env.example` to `.env`.
2. Choose a database:

   - For SQLite, set `DB_CONNECTION=sqlite`, remove the other `DB_*` values, and create an empty `database/database.sqlite` file.
   - For MySQL, create a database named `event_registration` and retain or update the `DB_*` values.

3. Replace the example `ADMIN_EMAIL` and `ADMIN_PASSWORD` values in `.env`.
4. Install dependencies and initialize the application:

   ```bash
   composer install
   npm install
   php artisan key:generate
   php artisan migrate --seed
   npm run build
   ```

5. Start the application:

   ```bash
   composer run dev
   ```

6. Open the displayed local URL for the public event listing. Use `/login` for administrator access with the credentials configured in `.env`.

For the checked local development environment, the seeded credentials are:

- Email: `admin@example.com`
- Password: `admin123`

These credentials are for local development only and must be replaced before deployment.

Run the feature tests with:

```bash
php artisan test
```

## MVC structure

### Models

- `User`
- `Event`
- `Registration`

### Controllers

- `EventController` for the public listing, search, filtering, and event details.
- `RegistrationController` for displaying and processing registration forms.
- `AdminEventController` for creating and publishing events.
- Laravel authentication controllers or actions for administrator sign-in and sign-out.

### Views

- Shared public layout.
- Event listing.
- Event details.
- Registration form.
- Registration confirmation.
- Administrator sign-in.
- Administrator dashboard.
- Administrator event creation form.

## Personas

### Persona 1: Maya - event visitor

- **Context:** Maya is a student who usually browses on her phone.
- **Goal:** Find a relevant upcoming event and register for it.
- **Behavior:** Searches with a few keywords and scans event dates and formats.
- **Needs:** A responsive layout, clear event information, and a short registration form.
- **Frustrations:** Crowded pages, unclear filters, and forms that do not explain errors.

### Persona 2: Jordan - event administrator

- **Context:** Jordan is an event administrator responsible for publishing events but is not a developer.
- **Goal:** Create an event and make it visible to visitors.
- **Behavior:** Signs in, enters structured event information, reviews it, and publishes it.
- **Needs:** Clearly labelled fields, understandable validation, and an obvious publication state.
- **Frustrations:** Technical error messages and uncertainty about whether an event is public.

## Primary user journeys

### Visitor journey

1. Open the application and immediately see the public event listing.
2. Search by keyword and optionally select an event format.
3. Open an event detail page.
4. Select the registration action.
5. Enter a name and email address.
6. Submit the form and receive confirmation.

### Administrator journey

1. Open the administrator sign-in page.
2. Sign in using valid credentials.
3. Open the create-event form.
4. Enter valid event information and create the event as unpublished.
5. Review the event from the administrator dashboard.
6. Publish the event.
7. Confirm that it appears in the public listing.

## User stories and acceptance criteria

### US-01: Search and filter events

**As a visitor, I want to search and filter upcoming events so that I can find an event relevant to me.**

Acceptance criteria:

- Opening the application root URL displays the public event listing without an intermediate landing page.
- The public listing displays only published upcoming events.
- Events are ordered by start date and time, with the earliest event first.
- A visitor can search using words from an event title or description.
- A visitor can filter by in-person, online, or hybrid format.
- Search and format filtering can be used together.
- The submitted keyword and selected format remain visible after the search.
- Each result displays its title, date, time, and format.
- Each result links to its event detail page.
- When no events match, the page displays a helpful no-results message.
- Search and filtering work through a standard server-rendered form without requiring JavaScript.

### US-02: View event details

**As a visitor, I want to view complete event details so that I can decide whether to register.**

Acceptance criteria:

- The page displays the event title, description, date, start and end time, format, and location or online-delivery information.
- The page displays a registration action when the event accepts registrations.
- Dates and times are presented in a readable format.
- An unpublished event cannot be accessed through a public URL.
- A missing or unavailable event returns a helpful not-found page.

### US-03: Register for an event

**As a visitor, I want to submit a registration form so that I can register for an event.**

Acceptance criteria:

- The form contains a name field and an email-address field.
- Both fields are required and have visible labels.
- The server validates the submitted name and email address.
- An invalid submission displays a clear error summary and a specific error beside each invalid field.
- Valid values remain in the form after a validation error.
- A valid submission creates one registration associated with the selected event.
- After successful submission, the visitor sees a confirmation containing the event title.
- Refreshing the confirmation page does not create another registration.
- Registrations cannot be submitted for unpublished or past events.
- Registration works without JavaScript.

### US-04: Administrator sign-in

**As an administrator, I want to sign in so that only an authorized user can create and publish events.**

Acceptance criteria:

- An unauthenticated visitor cannot access administrator pages.
- The sign-in form contains labelled email and password fields.
- Invalid credentials produce a generic error that does not reveal whether an account exists.
- Valid credentials redirect the administrator to the dashboard.
- The administrator can sign out from the dashboard.
- State-changing requests use CSRF protection.

### US-05: Create and publish an event

**As an administrator, I want to create and publish an event so that it appears in the public listing.**

Acceptance criteria:

- The event form contains title, description, start date and time, end date and time, format, and location or online-delivery information.
- Every field has a visible label.
- The server validates every required field.
- The end date and time cannot be earlier than the start date and time.
- Creating an event stores it as unpublished.
- The dashboard clearly identifies the event as unpublished.
- The administrator can publish an unpublished event from the dashboard.
- Publishing requires an explicit confirmation.
- After publication, the event appears in the public listing when it is upcoming.
- Public users cannot perform create or publish actions.

## Accessibility requirements

The project will focus on two important accessibility practices and apply them consistently across every page.

### 1. Semantic structure and keyboard accessibility

- Use semantic elements such as `header`, `nav`, `main`, `form`, and `button`.
- Use one clear page heading and a logical heading hierarchy.
- Provide a skip link that moves keyboard focus to the main content.
- Make every link, button, form field, and filter operable with a keyboard.
- Preserve a logical focus order.
- Provide a clearly visible focus indicator.
- Do not create clickable `div` or `span` elements when a native link or button is appropriate.
- Use descriptive link and button text.

### 2. Accessible forms and validation

- Give every form control a visible, programmatically associated label.
- Do not use placeholder text as a replacement for a label.
- Identify required fields in text and programmatically.
- Validate all forms on the server.
- Display an error summary at the beginning of an invalid form.
- Link each error-summary item to its invalid field.
- Display a specific error beside each invalid field.
- Move focus to the error summary after an invalid server response.
- Do not communicate errors or success using color alone.
- Preserve valid user input after a validation error.

### Accessibility verification

- Complete the visitor and administrator journeys using only a keyboard.
- Confirm that focus is always visible and follows a logical order.
- Inspect headings, landmarks, labels, and accessible names using browser developer tools.
- Run axe or Lighthouse against the event listing, detail, registration, sign-in, dashboard, and create-event pages.
- Manually verify the registration and event-creation error flows.

## Responsive design requirements

- Use a mobile-first stylesheet.
- Support layouts from 320 CSS pixels through desktop widths.
- Test representative widths at 320, 768, 1024, and 1440 CSS pixels.
- Use flexible Grid or Flexbox layouts instead of fixed page widths.
- Display event cards in one column on small screens and multiple columns when space permits.
- Allow form controls and buttons to use the available width on small screens.
- Use relative units for text and spacing.
- Ensure content remains readable at 200% browser zoom.
- Avoid horizontal page scrolling at supported widths.
- Do not hide essential content or actions on small screens.

## Information architecture

```text
/                              Event listing, search, and filter
|-- /events/{event}            Event details
|-- /events/{event}/register   Registration form
|-- /events/{event}/confirmation
|-- /login
|-- /admin
|   |-- /admin/events/create
|   |-- /admin/events/{event}/publish
```

The exact Laravel route names may differ while preserving this user-facing structure.

## Data model

### User

- `id`
- `name`
- `email`
- `password`
- timestamps

Only a seeded administrator account is required for the initial version.

### Event

- `id`
- `title`
- `slug`
- `description`
- `start_at`
- `end_at`
- `format`: in person, online, or hybrid
- `location_details`
- `is_published`
- `published_at`
- timestamps

### Registration

- `id`
- `event_id`
- `name`
- `email`
- timestamps

An event has many registrations. A registration belongs to one event.

## Security and privacy requirements

- Require authentication for all administrator routes.
- Authorize create and publish actions on the server.
- Protect state-changing requests with Laravel CSRF protection.
- Validate all submitted values on the server.
- Escape user-provided content when rendering Blade templates.
- Store administrator passwords using Laravel password hashing.
- Do not expose registration names or email addresses on public pages.
- Do not commit passwords, database credentials, or application secrets.

## Testing plan

Laravel feature tests should cover:

- Public listings include published upcoming events.
- Public listings exclude unpublished and past events.
- Keyword search and format filtering return the expected events.
- Published event details are public.
- Unpublished event details are not public.
- Valid registration submissions are stored.
- Invalid registrations return validation errors.
- Guests cannot access administrator routes.
- An administrator can create an unpublished event.
- An administrator can publish an event.
- Published events appear in the public listing.

Manual tests should cover:

- Keyboard navigation.
- Visible focus.
- Form labels and validation errors.
- Mobile and desktop layouts.
- Browser zoom at 200%.

## Definition of done

The initial version is complete when:

- All five user stories satisfy their acceptance criteria.
- Visitors can search, filter, view, and register for a published event.
- An administrator can sign in, create an event, and publish it.
- Core workflows work without JavaScript.
- The two selected accessibility practices are implemented and manually verified.
- Representative pages have no serious or critical axe violations.
- Pages work at the defined responsive widths and at 200% zoom.
- Laravel feature tests cover the primary success, validation, publication, and authorization behaviors.
- Local installation and setup instructions are documented after the application is scaffolded.

## Proposed implementation sequence

1. Scaffold Laravel and configure MySQL.
2. Add the `Event` and `Registration` migrations and models.
3. Seed one administrator and several example events.
4. Build the responsive shared Blade layout.
5. Build the public event listing, search, and format filter.
6. Build the event detail page.
7. Build the registration form and confirmation page.
8. Add administrator authentication.
9. Build the administrator dashboard and create-event form.
10. Add the publish action.
11. Add feature tests.
12. Complete keyboard, form-accessibility, responsive, and zoom testing.

## License

A license has not yet been selected.
