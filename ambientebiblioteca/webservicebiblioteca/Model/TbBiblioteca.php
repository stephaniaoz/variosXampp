<?php
include_once("C:xampp\htdocs\webservicebiblioteca\db\database_utilities.php");

Class TbBiblioteca{

	public function listaDisponibilildad(){

		$query ="	SELECT lb.libro_titulo, es.estante_nombre, l.localizacion_localizacion, e.estado_nombre, c.categoria_nombre, u.usuario_nombre, id.* 
					FROM tb_itemlibrodisponibilidad id
					JOIN tb_libro lb ON lb.libro_codigo = id.libro_codigo
					JOIN tb_estante es ON es.estante_codigo = id.estante_codigo
					JOIN tb_estado e ON e.estado_codigo = id.estado_codigo
					JOIN tb_categoria c ON c.categoria_codigo = id.categoria_codigo
					JOIN tb_usuario u ON u.usuario_codigo = id.usuario_codigo
					JOIN tb_localizacion l ON l.localizacion_codigo = es.localizacion_codigo
					ORDER BY lb.libro_titulo, id.itelibdis_fechacreacion  ";

		$result = pg_query($query);

		return $result;
	}

	public function getCantidadTiqueteGenerado(){

		$query ="	SELECT count(*) as cantidadtiquete
					FROM tb_tiquete  ";

		$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

		$array = pg_fetch_assoc($result);			
		$cantidadtiquete = $array['cantidadtiquete'];

		return $cantidadtiquete;

	}

	public function getCantidadSolicitudes(){

		$query ="	SELECT count(*) as cantidadsolicitud
					FROM tb_solicitud  ";

		$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

		$array = pg_fetch_assoc($result);			
		$cantidadsolicitud = $array['cantidadsolicitud'];

		return $cantidadsolicitud;

	}

	public function getCantidadDisponibles(){

		$query ="	SELECT count(*) as cantidaddisponibles
					FROM tb_itemlibrodisponibilidad
					WHERE estado_codigo = 5  ";

		$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

		$array = pg_fetch_assoc($result);			
		$cantidaddisponibles = $array['cantidaddisponibles'];

		return $cantidaddisponibles;

	}

	public function getLibroMayorSolicitud(){

		$query ="									
				select l.libro_titulo||' con un total de '||con||' solicitudes.' as max  from (
					select distinct(lib) as li, count(lib) as con from (
						select i.libro_codigo as lib
						from tb_solicitud s
						join tb_itemlibrodisponibilidad i on i.itelibdis_codigo = s.itelibdis_codigo
						where s.itelibdis_codigo is not null
						--group by i.libro_codigo
						union all
						select i.libro_codigo as lib
						from tb_tiquete t
						join tb_itemlibrodisponibilidad i on i.itelibdis_codigo = t.itelibdis_codigo
						--group by i.libro_codigo
					) as t
					group by lib
					order by 2 desc

				) as t
				join tb_libro l on l.libro_codigo = t.li
				limit 1  ";

		$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

		$array = pg_fetch_assoc($result);			
		$mayor = $array['max'];

		return $mayor;

	}

	public function getDosLibrosMayorConsultado(){

		$query = "						
			select l.libro_titulo, con as max  from (
				select distinct(lib) as li, count(lib) as con from (
					select i.libro_codigo as lib
					from tb_solicitud s
					join tb_itemlibrodisponibilidad i on i.itelibdis_codigo = s.itelibdis_codigo
					where s.itelibdis_codigo is not null
					union all
					select i.libro_codigo as lib
					from tb_tiquete t
					join tb_itemlibrodisponibilidad i on i.itelibdis_codigo = t.itelibdis_codigo
				) as t
				group by lib
				order by 2 desc

			) as t
			join tb_libro l on l.libro_codigo = t.li
			limit 2  ";

		$result = pg_query($query) or die ('La consulta fallo: ' . pg_last_error());

		return $result;

	}

	public function listaTiquete(){

		$query ="	SELECT lb.libro_titulo, es.estante_nombre, l.localizacion_localizacion, e.estado_nombre, c.categoria_nombre, u.usuario_nombre, est.estado_nombre as estadotiquete, t.*, id.*
					FROM tb_tiquete t
					JOIN tb_itemlibrodisponibilidad id ON id.itelibdis_codigo = t.itelibdis_codigo
					JOIN tb_libro lb ON lb.libro_codigo = id.libro_codigo
					JOIN tb_estante es ON es.estante_codigo = id.estante_codigo
					JOIN tb_estado e ON e.estado_codigo = id.estado_codigo
					JOIN tb_categoria c ON c.categoria_codigo = id.categoria_codigo
					JOIN tb_usuario u ON u.usuario_codigo = id.usuario_codigo
					LEFT JOIN tb_estado est ON est.estado_codigo = t.estado_codigo
					JOIN tb_localizacion l ON l.localizacion_codigo = es.localizacion_codigo
					ORDER BY t.tiquete_fechacreacion, t.tiquete_codigoestudiante  ";

		$result = pg_query($query);

		return $result;
	}

	public function listaSolicitud(){

		$query ="	SELECT t.tipsol_descripcion, s.*
					FROM tb_solicitud s
					JOIN tb_tiposolicitud t ON t.tipsol_codigo = s.tipsol_codigo
					ORDER BY  s.solicitud_fechasolicitud ";

		$result = pg_query($query);

		return $result;
	}

}


?>