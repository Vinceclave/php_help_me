📚 Book Inventory Application
📦 DATABASE
Table Name: Books

Column Name	Data Type	Description
ISBN	VARCHAR (PK)	Primary key, unique for each book
Title	VARCHAR	Book title
    Copyright	INT	Year of copyright
Edition	VARCHAR	Book edition
Price	DECIMAL(10,2)	Price of a single unit
Quantity	INT	Number of copies

Extra Calculation (on display only):

TOTAL = Price * Quantity

🧠 BACKEND FUNCTIONALITY
Each functionality has UI (1 point) and Functionality (3 points) for grading.

🔍 SEARCH (UI [1], Functionality [3])
User enters ISBN.

If found:

Populate all fields.

Prompt: "ITEM IS FOUND".

If not found:

Show empty fields.

Prompt: "ITEM NOT FOUND".

If ISBN is blank:

Prompt: "ISBN# SHOULD BE SUPPLIED".

📝 EDIT (UI [1], Functionality [3])
Requires a successful SEARCH first.

If no prior search:

Prompt: "NO RECORD TO EDIT".

If ISBN is not found:

Prompt: "ISBN# IS NOT FOUND".

If record found and form is filled:

Allow editing of all fields except ISBN.

Prompt: "RECORD SUCCESSFULLY UPDATED".

➕ ADD (UI [1], Functionality [3])
If form is blank:

Prompt: "NO RECORD TO ADD", focus on ISBN.

If ISBN already exists:

Prompt: "RECORD ALREADY EXISTS", focus on ISBN.

If new:

Add the record.

Prompt: "RECORD SUCCESSFULLY SAVED".

❌ DELETE (UI [1], Functionality [3])
Requires successful SEARCH first.

If record is found:

Delete the record.

Prompt: "RECORD SUCCESSFULLY DELETED".

Refresh the list after deletion.

📋 LIST VIEW
Shows:

All records in a table.

TOTAL = Price * Quantity for each row.

At bottom:

Total number of books.

Grand total value of all book totals.

💻 FRONTEND (UI DESIGN)
🔢 Form Fields:
ISBN#: (input) (required for search, not editable in edit)

Title: (input)

Copyright: (input)

Edition: (input)

Price: (input)

Quantity: (input)

🔘 Buttons:
SEARCH – Find by ISBN

EDIT – Update after successful search

ADD – Insert new book

DELETE – Remove after successful search

LIST – Display all books with totals

🖥️ Display Area:
Table/List of books

PROMPT section to display all error/success messages

Total number of records

Grand total value of all books