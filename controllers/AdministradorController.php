<?php
// require_once 'config/parametros.php';
// require_once 'models/administrador.php';
class AdministradorController
{
    public function index()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
        }
        require 'models/Categoria.php';

        $categoria = new Categoria();
        $categorias = $categoria->listar();

        require 'models/Calidad.php';
        $calidad = new Calidad();
        $calidades = $calidad->listar();

        require 'models/Producto.php';
        $producto = new Producto();
        $productos = $producto->listar();

        require 'views/administrador/home.php';
    }
    public function login()
    {
        if (!isset($_SESSION['usuario'])) {
            require 'models/Administrador.php';
            $administrador = new Administrador();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $administrador->setEmail($email);
            $administrador->setPassword($password);
            $res = $administrador->login();
            if ($res) {
                echo 'entro1';
                die();
                // $_SESSION['usuario'] = $administrador;
                // $_SESSION['rol'] = 'administrador';
                header("Location:" . base_url . 'administrador/index');
            } else {
                $_SESSION['alert'] = 'login_failed';
                header("Location:" . base_url . 'home/secret');
            }
        }
        // require_once 'views/administrador/home.php';
    }

    public function clientes()
    {
        require_once 'models/Cliente.php';
        $cliente = new Cliente();
        $clientes = $cliente->listar();
        require_once 'views/administrador/clientes.php';
    }
    public function vendedores()
    {
        require_once 'models/Vendedor.php';
        $vendedor = new Vendedor();
        $vendedores = $vendedor->listar();
        require_once 'views/administrador/vendedores.php';
    }
    public function categorias()
    {
        require_once 'models/Categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->listar();
        require_once 'views/administrador/categorias.php';
    }
    public function calidad()
    {
        require_once 'models/Calidad.php';
        $calidad = new Calidad();
        $calidades = $calidad->listar();
        require_once 'views/administrador/calidad.php';
    }
    public function registrarCalidad()
    {
        if (isset($_SESSION['usuario'])) {
            # code...
        }
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            if ($nombre) {
                require_once 'models/Calidad.php';
                $calidad = new Calidad();
                $calidad->setNombre($nombre);
                $save = $calidad->insertar();
                if ($save) {
                    $_SESSION['alert'] = 'register_complete';
                    header("Location:" . base_url . 'administrador/calidad');
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/calidad');
                }
            } else {
                $_SESSION['alert'] = 'register_failed';
                header("Location:" . base_url . 'administrador/calidad');
            }
        }
    }

    public function eliminarCalidad()
    {
        if (isset($_POST['id'])) {
            require 'models/Calidad.php';
            $calidad = new Calidad();
            $calidad->setId($_POST['id']);
            $delete = $calidad->eliminar();
            if ($delete) {
                $_SESSION['alert'] = 'delete_complete';
                header("Location:" . base_url . 'administrador/calidad');
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/calidad');
            }
        } else {
            $_SESSION['alert'] = 'delete_failed';
            header("Location:" . base_url . 'administrador/calidad');
        }
    }

    public function registrarCategoria()
    {
        if (isset($_SESSION['usuario'])) {
            # code...
        }
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            if ($nombre) {
                require_once 'models/Categoria.php';
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                $save = $categoria->insertar();
                if ($save) {
                    $_SESSION['alert'] = 'register_complete';
                    header("Location:" . base_url . 'administrador/categorias');
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/categorias');
                }
            } else {
                $_SESSION['alert'] = 'register_failed';
                header("Location:" . base_url . 'administrador/categorias');
            }
        }
    }

    public function eliminarCategoria()
    {
        if (isset($_POST['id'])) {
            require 'models/Categoria.php';
            $categoria = new Categoria();
            $categoria->setId($_POST['id']);
            $delete = $categoria->eliminar();
            if ($delete) {
                $_SESSION['alert'] = 'delete_complete';
                header("Location:" . base_url . 'administrador/categorias');
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/categorias');
            }
        } else {
            $_SESSION['alert'] = 'delete_failed';
            header("Location:" . base_url . 'administrador/categorias');
        }
    }

    public function registrarProducto()
    {
        if (isset($_SESSION['usuario'])) {
            # code...
        }
        if (isset($_POST)) {
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
            $calidad_id = isset($_POST['calidad_id']) ? $_POST['calidad_id'] : false;
            $precio =  isset($_POST['precio']) ? $_POST['precio'] : false;
            if ($titulo && $descripcion && $categoria_id && $calidad_id) {
                require_once 'models/Producto.php';
                $producto = new Producto();
                $producto->setTitulo($titulo);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria_id);
                $producto->setCalidad_id($calidad_id);
                $producto->setPrecio($precio);
                $save = $producto->insertar();
                if ($save) {
                    $_SESSION['alert'] = 'register_complete';
                    header("Location:" . base_url . 'administrador/index');
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/index');
                }
            } else {
                $_SESSION['alert'] = 'register_failed';
                header("Location:" . base_url . 'administrador/index');
            }
        }
    }

    public function eliminarProducto()
    {
        if (isset($_POST['id'])) {
            require 'models/Producto.php';
            $producto = new Producto();
            $producto->setId($_POST['id']);
            $delete = $producto->eliminar();
            if ($delete) {
                $_SESSION['alert'] = 'delete_complete';
                header("Location:" . base_url . 'administrador/index');
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/index');
            }
        } else {
            $_SESSION['alert'] = 'delete_failed';
            header("Location:" . base_url . 'administrador/index');
        }
    }

    public function verProducto()
    {
        # code...
    }

    public function registrarVendedor()
    {
        if (isset($_SESSION['usuario'])) {
            # code...
        }
        if (isset($_POST)) {
            $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
            $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
            $email =  isset($_POST['email']) ? $_POST['email'] : false;
            if ($nombres && $apellidos && $documento && $celular && $email) {
                require 'models/Vendedor.php';
                $vendedor = new Vendedor();
                $vendedor->setNombres($nombres);
                $vendedor->setApellidos($apellidos);
                $vendedor->setDocumento($documento);
                $vendedor->setCelular($celular);
                $vendedor->setEmail($email);
                $save = $vendedor->insertar();
                if ($save) {
                    $_SESSION['alert'] = 'register_complete';
                    header("Location:" . base_url . 'administrador/vendedores');
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/vendedores');
                }
            } else {
                $_SESSION['alert'] = 'register_failed';
                header("Location:" . base_url . 'administrador/vendedores');
            }
        }
    }
    public function eliminarVendedor()
    {
        if (isset($_POST['id'])) {
            require 'models/Vendedor.php';
            $vendedor = new Vendedor();
            $vendedor->setId($_POST['id']);
            $delete = $vendedor->eliminar();
            if ($delete) {
                $_SESSION['alert'] = 'delete_complete';
                header("Location:" . base_url . 'administrador/vendedores');
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/vendedores');
            }
        } else {
            $_SESSION['alert'] = 'delete_failed';
            header("Location:" . base_url . 'administrador/vendedores');
        }
    }

    public function registrarCliente()
    {
        if (isset($_SESSION['usuario'])) {
            # code...
        }
        if (isset($_POST)) {
            $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
            $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
            $email =  isset($_POST['email']) ? $_POST['email'] : false;
            if ($nombres && $apellidos && $documento && $celular && $email) {
                require 'models/Cliente.php';
                $cliente = new Cliente();
                $cliente->setNombres($nombres);
                $cliente->setApellidos($apellidos);
                $cliente->setDocumento($documento);
                $cliente->setCelular($celular);
                $cliente->setEmail($email);
                $save = $cliente->insertar();
                if ($save) {
                    $_SESSION['alert'] = 'register_complete';
                    header("Location:" . base_url . 'administrador/clientes');
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/clientes');
                }
            } else {
                $_SESSION['alert'] = 'register_failed';
                header("Location:" . base_url . 'administrador/clientes');
            }
        }
    }
    public function eliminarCliente()
    {
        if (isset($_POST['id'])) {
            require 'models/Cliente.php';
            $cliente = new Cliente();
            $cliente->setId($_POST['id']);
            $delete = $cliente->eliminar();
            if ($delete) {
                $_SESSION['alert'] = 'delete_complete';
                header("Location:" . base_url . 'administrador/clientes');
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/clientes');
            }
        } else {
            $_SESSION['alert'] = 'delete_failed';
            header("Location:" . base_url . 'administrador/clientes');
        }
    }
}
