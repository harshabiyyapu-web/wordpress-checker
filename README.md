# NH Solutions Invoice Studio

Custom invoicing software for NH Solutions. It is designed to:

- save a reusable company preset with supplier, tax, and bank details
- transform source invoice text into a new NH Solutions invoice
- let you change only the required fields such as client, dates, and amount
- generate a cleaner printable invoice based on the `NH SOLUTIONS.pdf` style

## Run

```bash
npm start
```

Then open `http://localhost:8080`.

## Main workflow

1. Click `Load NH preset` to restore the saved NH Solutions company details.
2. Upload an Adsterra PDF with `Upload PDF` or paste invoice text into `Source invoice import`.
3. Click `Parse text` only when you are pasting raw text manually.
4. Review or edit the invoice details and amount.
5. Click `Save preset` if you want to keep the current company/template setup.
6. Click `Print / PDF` to generate the final invoice.

## Included sample mapping

The app includes a built-in Adsterra sample importer based on:

- `/Users/harshabiyyapu/Downloads/Adsterra Invoice (3).pdf`
- `/Users/harshabiyyapu/Downloads/NH SOLUTIONS.pdf`

Use `Load Adsterra sample` to see the full mapped example instantly.
