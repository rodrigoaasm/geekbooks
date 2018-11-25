@include('../templates/headerbase')
<div class='container container-body footerAjust'>

    <div>
        <h2 class="text-center">Motivation</h2>
        <ul>
            <li>This Site was created by group of students of <a href="https://unifei.edu.br/">Unifei</a>, as the final exercise of <a href="https://baldochi.unifei.edu.br/COM222/">COM222</a>. </li>
            <li>Some parts of it's design, like the cart was based on <a href="https://www.americanas.com.br/">Americanas</a>, other's parts  
                took in consideration the site that was propose to follow <a href="https://http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/.americanas.com.br/">Geek Books</a></li>
            <li>All the design was made on the principles of responsiveness, so the site would be accessible by every kind of device </li>
        </ul>
    </div>

    <div>
        <h2 class="text-center">How it works</h2>
        <ul>
            <li>All product information is dynamically generated using the framework Laravel(based on php) and MySQL.</li>
            <li>Product, customer and order information is stored in a MySQL database, and the cart is stored in cookies.</li>
            <li><span class="subHead">MySQL Database: Tables: </span>
                <ul>
                    <li>bookdescriptions (This table contains the details about the book)</li>
                    <li>bookcategories (This table has the categories of the books)</li>
                    <li>bookcategoriesbooks (This table represents the relationship between books and categories. The kind of relationship is many-to-many) </li>
                    <li>bookauthors (This table contains the authors)</li>
                    <li>bookauthorsbooks (This table represents the relationship between authors and books. The kind of relationship is many-to-many) </li>
                    <li>bookcustomers (This table is used to store customers)</li>
                    <li>bookorders (This table is used to store orders)</li>
                    <li>bookorderitems (This table is used to store order items of a specific order. The kind of relationship is one-to-many) </li>
                </ul>
            </li>
        </ul>

    </div>

    <div>
        <h2 class="text-center">Structure of the site</h2>
        <ul>
            <li><span class="subHead">Home page</span>
                <ul>
                    <li>Display four random books from the
                        database using a SQL statement. 
                        For every book, will be shown the title of the book, it's photo, and description's</li>
                    <li>Truncates book descriptions at 250 characters.</li>
                    <li>Generates the browse menu dynamically from the database using a SQL query that shows
                        only the book categories that currently contain books. 
                        The menu also has an item called order history</li>
                    <li>Also has an option to search the book</li>
                </ul>
            </li>
            <li><span class="subHead">Search page</span>
                <ul>
                    <li>Cleans user entered data to protect against SQL Injection attacks and cross-site scripting. </li>
                    <li>Searches book title, description, author and
                        category fields in the database.</li>
                    <li>The return could be all the books that has any match or even empty.</li>
                </ul>
            </li>
            <li><span class="subHead">Shopping cart page</span>
                <ul>
                    <li>Uses a cookie to store the ISBNs of the books, as well the quantity</li>
                    <li>The cart page allows to see all the chosen books, an allows to change it's quantity or even remove it. </li>
                    <li>Also has the subtotal e shipping values, and the cart has to other options, continue to buy or finish it</li>
                </ul>
            </li>
            <li><span class="subHead">Checkout pages</span>
                <ul>
                    <li>Searches the database for email addresses of existing
                        customer accounts and writes their shipping information in
                        the form on the order confirmation page.</li>
                    <li>If the customer had made an previous order, will be shown it's data, only needing him to confirm
                    </li>
                </ul>
            </li>
            <li><span class="subHead">Order Confirmation Page</span>
                <ul>
                    <li>All fields are checked to make sure that they contain
                        information.</li>
                    <li>Modifications made to customer information are updated in
                        the database.</li>
                    <li>Order information are written to the database.</li>
                    <li>An email is sent to the customer with the order
                        information.</li>
                    <li>It clears the cart after the order is confirm.</li>
                </ul>
            </li>
            <li><span class="subHead">Order History Page</span>
                <ul>
                    <li>Searches the database for all orders associated with
                        e-mail address</li>
                    <li>If no matching email address is found user is prompted to
                        try again.</li>
                </ul>
            </li>
        </ul>
    </div>

</div>

</body>
@include('../templates/footerBase')