from flask import Flask, render_template, request, redirect, url_for
import mysql.connector

app = Flask(__name__)

# Connect to MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="books"
)

cursor = db.cursor()

# Create books table if not exists
cursor.execute('''
    CREATE TABLE IF NOT EXISTS books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL
    )
''')
db.commit()

@app.route('/')
def index():
    cursor.execute('SELECT * FROM books')
    books = cursor.fetchall()
    return render_template('index.html', books=books)

@app.route('/add', methods=['POST'])
def add_book():
    title = request.form['title']
    author = request.form['author']
    cursor.execute('INSERT INTO books (title, author) VALUES (%s, %s)', (title, author))
    db.commit()
    return redirect(url_for('index'))

@app.route('/edit/<int:id>', methods=['GET', 'POST'])
def edit_book(id):
    if request.method == 'GET':
        cursor.execute('SELECT * FROM books WHERE id = %s', (id,))
        book = cursor.fetchone()
        return render_template('edit.html', book=book)
    else:
        title = request.form['title']
        author = request.form['author']
        cursor.execute('UPDATE books SET title = %s, author = %s WHERE id = %s', (title, author, id))
        db.commit()
        return redirect(url_for('index'))

@app.route('/delete/<int:id>')
def delete_book(id):
    cursor.execute('DELETE FROM books WHERE id = %s', (id,))
    db.commit()
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)
