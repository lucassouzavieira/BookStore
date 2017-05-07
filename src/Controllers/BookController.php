<?php

namespace App\Controllers;

use App\Collections\Book;
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    protected $bookCollection;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->bookCollection = new Book($app);
    }

    public function index()
    {
        return $this->app['twig']->render('index.twig', [
            'books' => $this->bookCollection->all()
        ]);
    }

    public function create()
    {
        return $this->app['twig']->render('create.twig');
    }

    public function store(Request $request)
    {
        $data = (array) $request->request;
        $data = array_pop($data);

        try {
            if ($this->bookCollection->validate($data)) {
                $result = $this->bookCollection->save($data);
                return RedirectResponse::create('/index');
            }

            return RedirectResponse::create('/create');
        } catch (\Exception $exception) {
            return $this->app['twig']->render('error.twig', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        if ($this->bookCollection->find($id)) {
            return $this->app['twig']->render('update.twig', [
                'book' => $this->bookCollection->find($id)
            ]);
        }

        return $this->app['twig']->render('error.twig', [
            'message' => 'Document not found'
        ]);
    }

    public function update($id, Request $request)
    {
        $data = (array) $request->request;
        $data = array_pop($data);

        try {
            if ($this->bookCollection->validate($data)) {
                $result = $this->bookCollection->update($id, $data);
                return RedirectResponse::create('/index');
            }

            return RedirectResponse::create('/create');
        } catch (\Exception $exception) {
            return $this->app['twig']->render('error.twig', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $this->bookCollection->delete($id);
            return RedirectResponse::create('/index');
        } catch (\Exception $exception) {
            return $this->app['twig']->render('error.twig', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function details($id)
    {
        if ($this->bookCollection->find($id)) {
            return $this->app['twig']->render('details.twig', [
                'book' => $this->bookCollection->find($id)
            ]);
        }

        return $this->app['twig']->render('error.twig', [
            'message' => 'Document not found'
        ]);
    }
}
