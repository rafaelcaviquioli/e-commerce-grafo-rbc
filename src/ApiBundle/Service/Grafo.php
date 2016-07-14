<?php

namespace ApiBundle\Service;

class Grafo
{
    var $vertices = array();
    var $arestas = array();

    function adicionarVertice($vertice)
    {
        $this->vertices[] = $vertice;
    }

    function adicionarAresta($v1, $v2, $custo = 1)
    {
        $this->arestas[] = array("v1" => $v1, "v2" => $v2, "custo" => $custo);

        return $this;
    }

    function getVertices()
    {
        return $this->vertices;
    }

    function getArestas()
    {
        return $this->arestas;
    }

    function getAdjascencias($vertice, $limit = -1)
    {
        $adjs = array();
        $i = 0;
        foreach ($this->arestas as $aresta) {
            if($limit != -1 AND $i >= $limit ){
                return $adjs;
            }
            $i++;
            $novo = "";
            if ($aresta["v1"] == $vertice) {
                $novo = $aresta["v2"];
            }
            if ($aresta["v2"] == $vertice) {
                $novo = $aresta["v1"];
            }
            if ($novo != "") {
                $ha = false;
                foreach ($adjs as $adj) {
                    if ($adj == $novo) {
                        $ha = true;
                    }
                }
                if ($ha == false) {
                    $adjs[] = $novo;
                }
            }
        }
        return $adjs;
    }

    function getPeso($v1, $v2)
    {
        foreach ($this->arestas as $aresta) {
            if (
                ($aresta["v1"] == $v1 && $aresta["v2"] == $v2)
                ||
                ($aresta["v2"] == $v1 && $aresta["v2"] == $v1)
            ) {
                return $aresta["custo"];
            }
            return 0;
        }
    }
}