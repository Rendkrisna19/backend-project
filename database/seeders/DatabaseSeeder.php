<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Book;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Users (demo) =====
        User::updateOrCreate(
            ['email' => 'admin@buku.test'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'user@buku.test'],
            ['name' => 'User', 'password' => Hash::make('password'), 'role' => 'user']
        );

        // ===== Teams (penanda React) =====
        Team::query()->delete(); // supaya tidak dobel saat seeding ulang
        Team::insert([
            ['name'=>'BuatkanBuku Team','member_name'=>'Rendy','role'=>'Front-end','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'BuatkanBuku Team','member_name'=>'Diva','role'=>'Back-end','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'BuatkanBuku Team','member_name'=>'Iqbal','role'=>'QA','created_at'=>now(),'updated_at'=>now()],
        ]);

        // ===== 100 Buku (judul nyata) =====
        // NOTE: ISBN dibuat dummy unik. Cover memakai satu gambar default.
        $now = Carbon::now();
        $titles = [
            // 1–20
            ['The Great Gatsby','F. Scott Fitzgerald',1925],
            ['To Kill a Mockingbird','Harper Lee',1960],
            ['1984','George Orwell',1949],
            ['Pride and Prejudice','Jane Austen',1813],
            ['Moby-Dick','Herman Melville',1851],
            ['War and Peace','Leo Tolstoy',1869],
            ['Crime and Punishment','Fyodor Dostoevsky',1866],
            ['The Catcher in the Rye','J.D. Salinger',1951],
            ['Brave New World','Aldous Huxley',1932],
            ['The Lord of the Rings','J.R.R. Tolkien',1954],
            ['The Hobbit','J.R.R. Tolkien',1937],
            ['Jane Eyre','Charlotte Brontë',1847],
            ['Wuthering Heights','Emily Brontë',1847],
            ['Anna Karenina','Leo Tolstoy',1878],
            ['Madame Bovary','Gustave Flaubert',1857],
            ['The Brothers Karamazov','Fyodor Dostoevsky',1880],
            ['One Hundred Years of Solitude','Gabriel García Márquez',1967],
            ['Love in the Time of Cholera','Gabriel García Márquez',1985],
            ['The Kite Runner','Khaled Hosseini',2003],
            ['A Thousand Splendid Suns','Khaled Hosseini',2007],
            // 21–40
            ['The Alchemist','Paulo Coelho',1988],
            ['The Da Vinci Code','Dan Brown',2003],
            ['Angels & Demons','Dan Brown',2000],
            ['The Girl with the Dragon Tattoo','Stieg Larsson',2005],
            ['The Hunger Games','Suzanne Collins',2008],
            ['Catching Fire','Suzanne Collins',2009],
            ['Mockingjay','Suzanne Collins',2010],
            ['Harry Potter and the Sorcerer\'s Stone','J.K. Rowling',1997],
            ['Harry Potter and the Chamber of Secrets','J.K. Rowling',1998],
            ['Harry Potter and the Prisoner of Azkaban','J.K. Rowling',1999],
            ['The Fault in Our Stars','John Green',2012],
            ['Looking for Alaska','John Green',2005],
            ['The Book Thief','Markus Zusak',2005],
            ['Life of Pi','Yann Martel',2001],
            ['The Road','Cormac McCarthy',2006],
            ['No Country for Old Men','Cormac McCarthy',2005],
            ['The Silent Patient','Alex Michaelides',2019],
            ['The Night Circus','Erin Morgenstern',2011],
            ['The Goldfinch','Donna Tartt',2013],
            ['The Secret History','Donna Tartt',1992],
            // 41–60
            ['The Handmaid\'s Tale','Margaret Atwood',1985],
            ['The Testaments','Margaret Atwood',2019],
            ['The Color Purple','Alice Walker',1982],
            ['Beloved','Toni Morrison',1987],
            ['Song of Solomon','Toni Morrison',1977],
            ['Invisible Man','Ralph Ellison',1952],
            ['Things Fall Apart','Chinua Achebe',1958],
            ['Half of a Yellow Sun','Chimamanda Ngozi Adichie',2006],
            ['Americanah','Chimamanda Ngozi Adichie',2013],
            ['The Underground Railroad','Colson Whitehead',2016],
            ['The Nickel Boys','Colson Whitehead',2019],
            ['Normal People','Sally Rooney',2018],
            ['Conversations with Friends','Sally Rooney',2017],
            ['The Vanishing Half','Brit Bennett',2020],
            ['Where the Crawdads Sing','Delia Owens',2018],
            ['The Girl on the Train','Paula Hawkins',2015],
            ['Gone Girl','Gillian Flynn',2012],
            ['The Martian','Andy Weir',2011],
            ['Project Hail Mary','Andy Weir',2021],
            ['Ready Player One','Ernest Cline',2011],
            // 61–80
            ['Dune','Frank Herbert',1965],
            ['Neuromancer','William Gibson',1984],
            ['Foundation','Isaac Asimov',1951],
            ['Fahrenheit 451','Ray Bradbury',1953],
            ['Do Androids Dream of Electric Sheep?','Philip K. Dick',1968],
            ['The Name of the Rose','Umberto Eco',1980],
            ['Norwegian Wood','Haruki Murakami',1987],
            ['Kafka on the Shore','Haruki Murakami',2002],
            ['The Wind-Up Bird Chronicle','Haruki Murakami',1994],
            ['The Little Prince','Antoine de Saint-Exupéry',1943],
            ['The Picture of Dorian Gray','Oscar Wilde',1890],
            ['Dracula','Bram Stoker',1897],
            ['Frankenstein','Mary Shelley',1818],
            ['The Old Man and the Sea','Ernest Hemingway',1952],
            ['For Whom the Bell Tolls','Ernest Hemingway',1940],
            ['A Farewell to Arms','Ernest Hemingway',1929],
            ['The Sun Also Rises','Ernest Hemingway',1926],
            ['Of Mice and Men','John Steinbeck',1937],
            ['The Grapes of Wrath','John Steinbeck',1939],
            ['East of Eden','John Steinbeck',1952],
            ['The Outsiders','S.E. Hinton',1967],
            ['The Bell Jar','Sylvia Plath',1963],
            ['The Color of Magic','Terry Pratchett',1983],
            ['Good Omens','Neil Gaiman & Terry Pratchett',1990],
            ['American Gods','Neil Gaiman',2001],
            ['Neverwhere','Neil Gaiman',1996],
            ['The Shadow of the Wind','Carlos Ruiz Zafón',2001],
            ['The Angel\'s Game','Carlos Ruiz Zafón',2008],
            ['A Game of Thrones','George R.R. Martin',1996],
            ['A Clash of Kings','George R.R. Martin',1998],
            ['A Storm of Swords','George R.R. Martin',2000],
            ['The Girl in the Spider\'s Web','David Lagercrantz',2015],
            ['Educated','Tara Westover',2018],
            ['Sapiens: A Brief History of Humankind','Yuval Noah Harari',2011],
            ['Homo Deus: A Brief History of Tomorrow','Yuval Noah Harari',2015],
            ['Atomic Habits','James Clear',2018],
            ['The Subtle Art of Not Giving a F*ck','Mark Manson',2016],
            ['Outliers','Malcolm Gladwell',2008],
            ['Thinking, Fast and Slow','Daniel Kahneman',2011],
            ['The 7 Habits of Highly Effective People','Stephen R. Covey',1989],
        ];

        // bersihkan dulu supaya tidak duplicate saat seeding berulang
        Book::query()->delete();

        $books = [];
        foreach ($titles as $i => [$title,$author,$year]) {
            $idx = $i + 1;
            $books[] = [
                'title'       => $title,
                'author'      => $author,
                // ISBN dummy unik 13 digit
                'isbn'        => '9789'.str_pad((string)$idx, 11, '0', STR_PAD_LEFT),
                'year'        => $year,
                'stock'       => random_int(1, 20),
                'cover_path'  => 'covers/default.jpg', // 1 gambar dipakai semua
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
        }

        Book::insert($books);
    }
}
