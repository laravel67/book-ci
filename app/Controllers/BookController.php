<?php

namespace App\Controllers;

// use Config\Services;
use App\Models\Book;
use CodeIgniter\Exceptions\PageNotFoundException;

class BookController extends BaseController
{
    protected $Book;
    protected $perPage = 10;

    protected $rules = [
        'title' => [
            'label' => 'Judul',
            'rules' => 'required|string|is_unique[books.title]|max_length[255]',
            'errors' => [
                'required' => '{field} harus diisi.',
                'string' => '{field} harus berupa teks.',
                'is_unique' => '{field} sudah ada sebelumnya.',
                'max_length' => '{field} tidak boleh melebihi {param} karakter.'
            ]
        ],
        'author' => [
            'label' => 'Penulis',
            'rules' => 'required|string|max_length[255]',
            'errors' => [
                'required' => '{field} harus diisi.',
                'string' => '{field} harus berupa teks.',
                'max_length' => '{field} tidak boleh melebihi {param} karakter.'
            ]
        ],
        'publisher' => [
            'label' => 'Penerbit',
            'rules' => 'required|string|max_length[255]',
            'errors' => [
                'required' => '{field} harus diisi.',
                'string' => '{field} harus berupa teks.',
                'max_length' => '{field} tidak boleh melebihi {param} karakter.'
            ]
        ],
        'cover' => [
            'label' => 'Cover',
            'rules' => 'is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,1024]',
            'errors' => [
                'is_image' => '{field} harus berupa gambar.',
                'mime_in' => '{field} harus memiliki format jpg, jpeg, atau png.',
                'max_size' => '{field} tidak boleh melebihi 1 MB.'
            ]
        ],
    ];

    public function __construct()
    {
        $this->Book = new Book();
    }

    public function index()
    {
        // $books = $this->Book->findAll();
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $data = [
            // 'books' => $books
            'books' => $this->Book->paginate($this->perPage),
            'pager' =>  $this->Book->pager,
            'currentPage' => $currentPage,
            'perPage' => $this->perPage,
        ];
        // $books = new Book();
        // $b = $books->findAll();
        return view('book/index', $data);
    }

    public function show($slug)
    {
        $data = [
            'book' => $this->Book->getBook($slug)
        ];
        if (empty($data['book'])) {
            throw new PageNotFoundException('Book ' . $slug . ' Not Found');
        } else {
            return view('book/show', $data);
        }
    }

    public function create()
    {
        // $data = [
        //     'errors' => Services::validation()
        // ];
        return view('book/create');
    }

    public function store()
    {
        helper('text');
        if (!$this->validate($this->rules)) {
            // $validation = Services::validation();
            // return redirect()->to(base_url('/book/create'))->withInput()->with('errors', $validation);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        };

        $fileCover = $this->request->getFile('cover');
        if ($fileCover->getError() == 4) {
            $fileName = 'default.jpg';
        } else {
            $fileName = random_string('alnum', 10) . '.' . $fileCover->getClientExtension();
            $fileCover->move(FCPATH . 'img', $fileName);
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->Book->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $fileName,
        ]);
        session()->setFlashdata('success', 'New book has been saved!');
        return redirect()->to(base_url('/books'));
    }

    public function edit($slug)
    {
        $data = [
            'book' => $this->Book->getBook($slug)
        ];
        if (empty($data['book'])) {
            throw new PageNotFoundException('Book ' . $slug . ' Not Found');
        } else {
            return view('book/edit', $data);
        }
    }

    public function update($id)
    {
        helper('text');
        $book = $this->Book->find($id);
        if (!$book) {
            throw new PageNotFoundException('Book with ID ' . $id . ' not found');
        }

        $inputTitle = $this->request->getVar('title');
        $rule = $this->rules;

        if ($book['title'] !== $inputTitle) {
            $rule['title']['rules'] .= '|is_unique[books.title]';
            $rule['title']['errors']['is_unique'] = '{field} sudah ada sebelumnya.';
        } else {
            // Hapus aturan is_unique jika judul tidak berubah
            $rule['title']['rules'] = str_replace('|is_unique[books.title]', '', $rule['title']['rules']);
        }
        if (!$this->validate($rule)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $newFile = $this->request->getFile('cover');
        $oldFile = $this->request->getVar('oldCover');

        if ($newFile->getError() == 4) {
            $fileName = $oldFile;
        } else {
            $fileName = random_string('alnum', 10) . '.' . $newFile->getClientExtension();
            $newFile->move(FCPATH . 'img', $fileName);
            if ($oldFile && $oldFile != 'default.jpg') {
                $oldCoverPath = FCPATH . 'img/' . $oldFile;
                if (is_file($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }
        }
        $slug = url_title($inputTitle, '-', true);
        $this->Book->save([
            'id' => $id,
            'title' => $inputTitle,
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $fileName,
        ]);
        session()->setFlashdata('success', 'Book has been updated!');
        return redirect()->to(base_url('/books'));
    }

    public function delete($id)
    {
        $book = $this->Book->find($id);
        if ($book) {
            if ($book['cover'] != 'default.jpg') {
                $filePath = FCPATH . 'img/' . $book['cover'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
            $this->Book->delete($id);
            session()->setFlashdata('success', 'Book has been deleted!');
        }
        return redirect()->to(base_url('/books'));
    }
}
