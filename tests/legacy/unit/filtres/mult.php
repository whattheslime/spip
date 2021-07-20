<?php
/**
 * Test unitaire de la fonction mult
 * du fichier inc/filtres.php
 *
 * genere automatiquement par TestBuilder
 * le 
 */

	$test = 'mult';
	$remonte = "../";
	while (!is_file($remonte."test.inc"))
		$remonte = "../$remonte";
	require $remonte.'test.inc';
	find_in_path("inc/filtres.php",'',true);

	//
	// hop ! on y va
	//
	$err = tester_fun('mult', essais_mult());
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<dl>' . join('', $err) . '</dl>');
	}

	echo "OK";
	

	function essais_mult(){
		$essais = array (
  0 => 
  array (
    0 => 0,
    1 => 0,
    2 => 0,
  ),
  1 => 
  array (
    0 => 0,
    1 => 0,
    2 => -1,
  ),
  2 => 
  array (
    0 => 0,
    1 => 0,
    2 => 1,
  ),
  3 => 
  array (
    0 => 0,
    1 => 0,
    2 => 2,
  ),
  4 => 
  array (
    0 => 0,
    1 => 0,
    2 => 3,
  ),
  5 => 
  array (
    0 => 0,
    1 => 0,
    2 => 4,
  ),
  6 => 
  array (
    0 => 0,
    1 => 0,
    2 => 5,
  ),
  7 => 
  array (
    0 => 0,
    1 => 0,
    2 => 6,
  ),
  8 => 
  array (
    0 => 0,
    1 => 0,
    2 => 7,
  ),
  9 => 
  array (
    0 => 0,
    1 => 0,
    2 => 10,
  ),
  10 => 
  array (
    0 => 0,
    1 => 0,
    2 => 20,
  ),
  11 => 
  array (
    0 => 0,
    1 => 0,
    2 => 30,
  ),
  12 => 
  array (
    0 => 0,
    1 => 0,
    2 => 50,
  ),
  13 => 
  array (
    0 => 0,
    1 => 0,
    2 => 100,
  ),
  14 => 
  array (
    0 => 0,
    1 => 0,
    2 => 1000,
  ),
  15 => 
  array (
    0 => 0,
    1 => 0,
    2 => 10000,
  ),
  16 => 
  array (
    0 => 0,
    1 => -1,
    2 => 0,
  ),
  17 => 
  array (
    0 => 1,
    1 => -1,
    2 => -1,
  ),
  18 => 
  array (
    0 => -1,
    1 => -1,
    2 => 1,
  ),
  19 => 
  array (
    0 => -2,
    1 => -1,
    2 => 2,
  ),
  20 => 
  array (
    0 => -3,
    1 => -1,
    2 => 3,
  ),
  21 => 
  array (
    0 => -4,
    1 => -1,
    2 => 4,
  ),
  22 => 
  array (
    0 => -5,
    1 => -1,
    2 => 5,
  ),
  23 => 
  array (
    0 => -6,
    1 => -1,
    2 => 6,
  ),
  24 => 
  array (
    0 => -7,
    1 => -1,
    2 => 7,
  ),
  25 => 
  array (
    0 => -10,
    1 => -1,
    2 => 10,
  ),
  26 => 
  array (
    0 => -20,
    1 => -1,
    2 => 20,
  ),
  27 => 
  array (
    0 => -30,
    1 => -1,
    2 => 30,
  ),
  28 => 
  array (
    0 => -50,
    1 => -1,
    2 => 50,
  ),
  29 => 
  array (
    0 => -100,
    1 => -1,
    2 => 100,
  ),
  30 => 
  array (
    0 => -1000,
    1 => -1,
    2 => 1000,
  ),
  31 => 
  array (
    0 => -10000,
    1 => -1,
    2 => 10000,
  ),
  32 => 
  array (
    0 => 0,
    1 => 1,
    2 => 0,
  ),
  33 => 
  array (
    0 => -1,
    1 => 1,
    2 => -1,
  ),
  34 => 
  array (
    0 => 1,
    1 => 1,
    2 => 1,
  ),
  35 => 
  array (
    0 => 2,
    1 => 1,
    2 => 2,
  ),
  36 => 
  array (
    0 => 3,
    1 => 1,
    2 => 3,
  ),
  37 => 
  array (
    0 => 4,
    1 => 1,
    2 => 4,
  ),
  38 => 
  array (
    0 => 5,
    1 => 1,
    2 => 5,
  ),
  39 => 
  array (
    0 => 6,
    1 => 1,
    2 => 6,
  ),
  40 => 
  array (
    0 => 7,
    1 => 1,
    2 => 7,
  ),
  41 => 
  array (
    0 => 10,
    1 => 1,
    2 => 10,
  ),
  42 => 
  array (
    0 => 20,
    1 => 1,
    2 => 20,
  ),
  43 => 
  array (
    0 => 30,
    1 => 1,
    2 => 30,
  ),
  44 => 
  array (
    0 => 50,
    1 => 1,
    2 => 50,
  ),
  45 => 
  array (
    0 => 100,
    1 => 1,
    2 => 100,
  ),
  46 => 
  array (
    0 => 1000,
    1 => 1,
    2 => 1000,
  ),
  47 => 
  array (
    0 => 10000,
    1 => 1,
    2 => 10000,
  ),
  48 => 
  array (
    0 => 0,
    1 => 2,
    2 => 0,
  ),
  49 => 
  array (
    0 => -2,
    1 => 2,
    2 => -1,
  ),
  50 => 
  array (
    0 => 2,
    1 => 2,
    2 => 1,
  ),
  51 => 
  array (
    0 => 4,
    1 => 2,
    2 => 2,
  ),
  52 => 
  array (
    0 => 6,
    1 => 2,
    2 => 3,
  ),
  53 => 
  array (
    0 => 8,
    1 => 2,
    2 => 4,
  ),
  54 => 
  array (
    0 => 10,
    1 => 2,
    2 => 5,
  ),
  55 => 
  array (
    0 => 12,
    1 => 2,
    2 => 6,
  ),
  56 => 
  array (
    0 => 14,
    1 => 2,
    2 => 7,
  ),
  57 => 
  array (
    0 => 20,
    1 => 2,
    2 => 10,
  ),
  58 => 
  array (
    0 => 40,
    1 => 2,
    2 => 20,
  ),
  59 => 
  array (
    0 => 60,
    1 => 2,
    2 => 30,
  ),
  60 => 
  array (
    0 => 100,
    1 => 2,
    2 => 50,
  ),
  61 => 
  array (
    0 => 200,
    1 => 2,
    2 => 100,
  ),
  62 => 
  array (
    0 => 2000,
    1 => 2,
    2 => 1000,
  ),
  63 => 
  array (
    0 => 20000,
    1 => 2,
    2 => 10000,
  ),
  64 => 
  array (
    0 => 0,
    1 => 3,
    2 => 0,
  ),
  65 => 
  array (
    0 => -3,
    1 => 3,
    2 => -1,
  ),
  66 => 
  array (
    0 => 3,
    1 => 3,
    2 => 1,
  ),
  67 => 
  array (
    0 => 6,
    1 => 3,
    2 => 2,
  ),
  68 => 
  array (
    0 => 9,
    1 => 3,
    2 => 3,
  ),
  69 => 
  array (
    0 => 12,
    1 => 3,
    2 => 4,
  ),
  70 => 
  array (
    0 => 15,
    1 => 3,
    2 => 5,
  ),
  71 => 
  array (
    0 => 18,
    1 => 3,
    2 => 6,
  ),
  72 => 
  array (
    0 => 21,
    1 => 3,
    2 => 7,
  ),
  73 => 
  array (
    0 => 30,
    1 => 3,
    2 => 10,
  ),
  74 => 
  array (
    0 => 60,
    1 => 3,
    2 => 20,
  ),
  75 => 
  array (
    0 => 90,
    1 => 3,
    2 => 30,
  ),
  76 => 
  array (
    0 => 150,
    1 => 3,
    2 => 50,
  ),
  77 => 
  array (
    0 => 300,
    1 => 3,
    2 => 100,
  ),
  78 => 
  array (
    0 => 3000,
    1 => 3,
    2 => 1000,
  ),
  79 => 
  array (
    0 => 30000,
    1 => 3,
    2 => 10000,
  ),
  80 => 
  array (
    0 => 0,
    1 => 4,
    2 => 0,
  ),
  81 => 
  array (
    0 => -4,
    1 => 4,
    2 => -1,
  ),
  82 => 
  array (
    0 => 4,
    1 => 4,
    2 => 1,
  ),
  83 => 
  array (
    0 => 8,
    1 => 4,
    2 => 2,
  ),
  84 => 
  array (
    0 => 12,
    1 => 4,
    2 => 3,
  ),
  85 => 
  array (
    0 => 16,
    1 => 4,
    2 => 4,
  ),
  86 => 
  array (
    0 => 20,
    1 => 4,
    2 => 5,
  ),
  87 => 
  array (
    0 => 24,
    1 => 4,
    2 => 6,
  ),
  88 => 
  array (
    0 => 28,
    1 => 4,
    2 => 7,
  ),
  89 => 
  array (
    0 => 40,
    1 => 4,
    2 => 10,
  ),
  90 => 
  array (
    0 => 80,
    1 => 4,
    2 => 20,
  ),
  91 => 
  array (
    0 => 120,
    1 => 4,
    2 => 30,
  ),
  92 => 
  array (
    0 => 200,
    1 => 4,
    2 => 50,
  ),
  93 => 
  array (
    0 => 400,
    1 => 4,
    2 => 100,
  ),
  94 => 
  array (
    0 => 4000,
    1 => 4,
    2 => 1000,
  ),
  95 => 
  array (
    0 => 40000,
    1 => 4,
    2 => 10000,
  ),
  96 => 
  array (
    0 => 0,
    1 => 5,
    2 => 0,
  ),
  97 => 
  array (
    0 => -5,
    1 => 5,
    2 => -1,
  ),
  98 => 
  array (
    0 => 5,
    1 => 5,
    2 => 1,
  ),
  99 => 
  array (
    0 => 10,
    1 => 5,
    2 => 2,
  ),
  100 => 
  array (
    0 => 15,
    1 => 5,
    2 => 3,
  ),
  101 => 
  array (
    0 => 20,
    1 => 5,
    2 => 4,
  ),
  102 => 
  array (
    0 => 25,
    1 => 5,
    2 => 5,
  ),
  103 => 
  array (
    0 => 30,
    1 => 5,
    2 => 6,
  ),
  104 => 
  array (
    0 => 35,
    1 => 5,
    2 => 7,
  ),
  105 => 
  array (
    0 => 50,
    1 => 5,
    2 => 10,
  ),
  106 => 
  array (
    0 => 100,
    1 => 5,
    2 => 20,
  ),
  107 => 
  array (
    0 => 150,
    1 => 5,
    2 => 30,
  ),
  108 => 
  array (
    0 => 250,
    1 => 5,
    2 => 50,
  ),
  109 => 
  array (
    0 => 500,
    1 => 5,
    2 => 100,
  ),
  110 => 
  array (
    0 => 5000,
    1 => 5,
    2 => 1000,
  ),
  111 => 
  array (
    0 => 50000,
    1 => 5,
    2 => 10000,
  ),
  112 => 
  array (
    0 => 0,
    1 => 6,
    2 => 0,
  ),
  113 => 
  array (
    0 => -6,
    1 => 6,
    2 => -1,
  ),
  114 => 
  array (
    0 => 6,
    1 => 6,
    2 => 1,
  ),
  115 => 
  array (
    0 => 12,
    1 => 6,
    2 => 2,
  ),
  116 => 
  array (
    0 => 18,
    1 => 6,
    2 => 3,
  ),
  117 => 
  array (
    0 => 24,
    1 => 6,
    2 => 4,
  ),
  118 => 
  array (
    0 => 30,
    1 => 6,
    2 => 5,
  ),
  119 => 
  array (
    0 => 36,
    1 => 6,
    2 => 6,
  ),
  120 => 
  array (
    0 => 42,
    1 => 6,
    2 => 7,
  ),
  121 => 
  array (
    0 => 60,
    1 => 6,
    2 => 10,
  ),
  122 => 
  array (
    0 => 120,
    1 => 6,
    2 => 20,
  ),
  123 => 
  array (
    0 => 180,
    1 => 6,
    2 => 30,
  ),
  124 => 
  array (
    0 => 300,
    1 => 6,
    2 => 50,
  ),
  125 => 
  array (
    0 => 600,
    1 => 6,
    2 => 100,
  ),
  126 => 
  array (
    0 => 6000,
    1 => 6,
    2 => 1000,
  ),
  127 => 
  array (
    0 => 60000,
    1 => 6,
    2 => 10000,
  ),
  128 => 
  array (
    0 => 0,
    1 => 7,
    2 => 0,
  ),
  129 => 
  array (
    0 => -7,
    1 => 7,
    2 => -1,
  ),
  130 => 
  array (
    0 => 7,
    1 => 7,
    2 => 1,
  ),
  131 => 
  array (
    0 => 14,
    1 => 7,
    2 => 2,
  ),
  132 => 
  array (
    0 => 21,
    1 => 7,
    2 => 3,
  ),
  133 => 
  array (
    0 => 28,
    1 => 7,
    2 => 4,
  ),
  134 => 
  array (
    0 => 35,
    1 => 7,
    2 => 5,
  ),
  135 => 
  array (
    0 => 42,
    1 => 7,
    2 => 6,
  ),
  136 => 
  array (
    0 => 49,
    1 => 7,
    2 => 7,
  ),
  137 => 
  array (
    0 => 70,
    1 => 7,
    2 => 10,
  ),
  138 => 
  array (
    0 => 140,
    1 => 7,
    2 => 20,
  ),
  139 => 
  array (
    0 => 210,
    1 => 7,
    2 => 30,
  ),
  140 => 
  array (
    0 => 350,
    1 => 7,
    2 => 50,
  ),
  141 => 
  array (
    0 => 700,
    1 => 7,
    2 => 100,
  ),
  142 => 
  array (
    0 => 7000,
    1 => 7,
    2 => 1000,
  ),
  143 => 
  array (
    0 => 70000,
    1 => 7,
    2 => 10000,
  ),
  144 => 
  array (
    0 => 0,
    1 => 10,
    2 => 0,
  ),
  145 => 
  array (
    0 => -10,
    1 => 10,
    2 => -1,
  ),
  146 => 
  array (
    0 => 10,
    1 => 10,
    2 => 1,
  ),
  147 => 
  array (
    0 => 20,
    1 => 10,
    2 => 2,
  ),
  148 => 
  array (
    0 => 30,
    1 => 10,
    2 => 3,
  ),
  149 => 
  array (
    0 => 40,
    1 => 10,
    2 => 4,
  ),
  150 => 
  array (
    0 => 50,
    1 => 10,
    2 => 5,
  ),
  151 => 
  array (
    0 => 60,
    1 => 10,
    2 => 6,
  ),
  152 => 
  array (
    0 => 70,
    1 => 10,
    2 => 7,
  ),
  153 => 
  array (
    0 => 100,
    1 => 10,
    2 => 10,
  ),
  154 => 
  array (
    0 => 200,
    1 => 10,
    2 => 20,
  ),
  155 => 
  array (
    0 => 300,
    1 => 10,
    2 => 30,
  ),
  156 => 
  array (
    0 => 500,
    1 => 10,
    2 => 50,
  ),
  157 => 
  array (
    0 => 1000,
    1 => 10,
    2 => 100,
  ),
  158 => 
  array (
    0 => 10000,
    1 => 10,
    2 => 1000,
  ),
  159 => 
  array (
    0 => 100000,
    1 => 10,
    2 => 10000,
  ),
  160 => 
  array (
    0 => 0,
    1 => 20,
    2 => 0,
  ),
  161 => 
  array (
    0 => -20,
    1 => 20,
    2 => -1,
  ),
  162 => 
  array (
    0 => 20,
    1 => 20,
    2 => 1,
  ),
  163 => 
  array (
    0 => 40,
    1 => 20,
    2 => 2,
  ),
  164 => 
  array (
    0 => 60,
    1 => 20,
    2 => 3,
  ),
  165 => 
  array (
    0 => 80,
    1 => 20,
    2 => 4,
  ),
  166 => 
  array (
    0 => 100,
    1 => 20,
    2 => 5,
  ),
  167 => 
  array (
    0 => 120,
    1 => 20,
    2 => 6,
  ),
  168 => 
  array (
    0 => 140,
    1 => 20,
    2 => 7,
  ),
  169 => 
  array (
    0 => 200,
    1 => 20,
    2 => 10,
  ),
  170 => 
  array (
    0 => 400,
    1 => 20,
    2 => 20,
  ),
  171 => 
  array (
    0 => 600,
    1 => 20,
    2 => 30,
  ),
  172 => 
  array (
    0 => 1000,
    1 => 20,
    2 => 50,
  ),
  173 => 
  array (
    0 => 2000,
    1 => 20,
    2 => 100,
  ),
  174 => 
  array (
    0 => 20000,
    1 => 20,
    2 => 1000,
  ),
  175 => 
  array (
    0 => 200000,
    1 => 20,
    2 => 10000,
  ),
  176 => 
  array (
    0 => 0,
    1 => 30,
    2 => 0,
  ),
  177 => 
  array (
    0 => -30,
    1 => 30,
    2 => -1,
  ),
  178 => 
  array (
    0 => 30,
    1 => 30,
    2 => 1,
  ),
  179 => 
  array (
    0 => 60,
    1 => 30,
    2 => 2,
  ),
  180 => 
  array (
    0 => 90,
    1 => 30,
    2 => 3,
  ),
  181 => 
  array (
    0 => 120,
    1 => 30,
    2 => 4,
  ),
  182 => 
  array (
    0 => 150,
    1 => 30,
    2 => 5,
  ),
  183 => 
  array (
    0 => 180,
    1 => 30,
    2 => 6,
  ),
  184 => 
  array (
    0 => 210,
    1 => 30,
    2 => 7,
  ),
  185 => 
  array (
    0 => 300,
    1 => 30,
    2 => 10,
  ),
  186 => 
  array (
    0 => 600,
    1 => 30,
    2 => 20,
  ),
  187 => 
  array (
    0 => 900,
    1 => 30,
    2 => 30,
  ),
  188 => 
  array (
    0 => 1500,
    1 => 30,
    2 => 50,
  ),
  189 => 
  array (
    0 => 3000,
    1 => 30,
    2 => 100,
  ),
  190 => 
  array (
    0 => 30000,
    1 => 30,
    2 => 1000,
  ),
  191 => 
  array (
    0 => 300000,
    1 => 30,
    2 => 10000,
  ),
  192 => 
  array (
    0 => 0,
    1 => 50,
    2 => 0,
  ),
  193 => 
  array (
    0 => -50,
    1 => 50,
    2 => -1,
  ),
  194 => 
  array (
    0 => 50,
    1 => 50,
    2 => 1,
  ),
  195 => 
  array (
    0 => 100,
    1 => 50,
    2 => 2,
  ),
  196 => 
  array (
    0 => 150,
    1 => 50,
    2 => 3,
  ),
  197 => 
  array (
    0 => 200,
    1 => 50,
    2 => 4,
  ),
  198 => 
  array (
    0 => 250,
    1 => 50,
    2 => 5,
  ),
  199 => 
  array (
    0 => 300,
    1 => 50,
    2 => 6,
  ),
  200 => 
  array (
    0 => 350,
    1 => 50,
    2 => 7,
  ),
  201 => 
  array (
    0 => 500,
    1 => 50,
    2 => 10,
  ),
  202 => 
  array (
    0 => 1000,
    1 => 50,
    2 => 20,
  ),
  203 => 
  array (
    0 => 1500,
    1 => 50,
    2 => 30,
  ),
  204 => 
  array (
    0 => 2500,
    1 => 50,
    2 => 50,
  ),
  205 => 
  array (
    0 => 5000,
    1 => 50,
    2 => 100,
  ),
  206 => 
  array (
    0 => 50000,
    1 => 50,
    2 => 1000,
  ),
  207 => 
  array (
    0 => 500000,
    1 => 50,
    2 => 10000,
  ),
  208 => 
  array (
    0 => 0,
    1 => 100,
    2 => 0,
  ),
  209 => 
  array (
    0 => -100,
    1 => 100,
    2 => -1,
  ),
  210 => 
  array (
    0 => 100,
    1 => 100,
    2 => 1,
  ),
  211 => 
  array (
    0 => 200,
    1 => 100,
    2 => 2,
  ),
  212 => 
  array (
    0 => 300,
    1 => 100,
    2 => 3,
  ),
  213 => 
  array (
    0 => 400,
    1 => 100,
    2 => 4,
  ),
  214 => 
  array (
    0 => 500,
    1 => 100,
    2 => 5,
  ),
  215 => 
  array (
    0 => 600,
    1 => 100,
    2 => 6,
  ),
  216 => 
  array (
    0 => 700,
    1 => 100,
    2 => 7,
  ),
  217 => 
  array (
    0 => 1000,
    1 => 100,
    2 => 10,
  ),
  218 => 
  array (
    0 => 2000,
    1 => 100,
    2 => 20,
  ),
  219 => 
  array (
    0 => 3000,
    1 => 100,
    2 => 30,
  ),
  220 => 
  array (
    0 => 5000,
    1 => 100,
    2 => 50,
  ),
  221 => 
  array (
    0 => 10000,
    1 => 100,
    2 => 100,
  ),
  222 => 
  array (
    0 => 100000,
    1 => 100,
    2 => 1000,
  ),
  223 => 
  array (
    0 => 1000000,
    1 => 100,
    2 => 10000,
  ),
  224 => 
  array (
    0 => 0,
    1 => 1000,
    2 => 0,
  ),
  225 => 
  array (
    0 => -1000,
    1 => 1000,
    2 => -1,
  ),
  226 => 
  array (
    0 => 1000,
    1 => 1000,
    2 => 1,
  ),
  227 => 
  array (
    0 => 2000,
    1 => 1000,
    2 => 2,
  ),
  228 => 
  array (
    0 => 3000,
    1 => 1000,
    2 => 3,
  ),
  229 => 
  array (
    0 => 4000,
    1 => 1000,
    2 => 4,
  ),
  230 => 
  array (
    0 => 5000,
    1 => 1000,
    2 => 5,
  ),
  231 => 
  array (
    0 => 6000,
    1 => 1000,
    2 => 6,
  ),
  232 => 
  array (
    0 => 7000,
    1 => 1000,
    2 => 7,
  ),
  233 => 
  array (
    0 => 10000,
    1 => 1000,
    2 => 10,
  ),
  234 => 
  array (
    0 => 20000,
    1 => 1000,
    2 => 20,
  ),
  235 => 
  array (
    0 => 30000,
    1 => 1000,
    2 => 30,
  ),
  236 => 
  array (
    0 => 50000,
    1 => 1000,
    2 => 50,
  ),
  237 => 
  array (
    0 => 100000,
    1 => 1000,
    2 => 100,
  ),
  238 => 
  array (
    0 => 1000000,
    1 => 1000,
    2 => 1000,
  ),
  239 => 
  array (
    0 => 10000000,
    1 => 1000,
    2 => 10000,
  ),
  240 => 
  array (
    0 => 0,
    1 => 10000,
    2 => 0,
  ),
  241 => 
  array (
    0 => -10000,
    1 => 10000,
    2 => -1,
  ),
  242 => 
  array (
    0 => 10000,
    1 => 10000,
    2 => 1,
  ),
  243 => 
  array (
    0 => 20000,
    1 => 10000,
    2 => 2,
  ),
  244 => 
  array (
    0 => 30000,
    1 => 10000,
    2 => 3,
  ),
  245 => 
  array (
    0 => 40000,
    1 => 10000,
    2 => 4,
  ),
  246 => 
  array (
    0 => 50000,
    1 => 10000,
    2 => 5,
  ),
  247 => 
  array (
    0 => 60000,
    1 => 10000,
    2 => 6,
  ),
  248 => 
  array (
    0 => 70000,
    1 => 10000,
    2 => 7,
  ),
  249 => 
  array (
    0 => 100000,
    1 => 10000,
    2 => 10,
  ),
  250 => 
  array (
    0 => 200000,
    1 => 10000,
    2 => 20,
  ),
  251 => 
  array (
    0 => 300000,
    1 => 10000,
    2 => 30,
  ),
  252 => 
  array (
    0 => 500000,
    1 => 10000,
    2 => 50,
  ),
  253 => 
  array (
    0 => 1000000,
    1 => 10000,
    2 => 100,
  ),
  254 => 
  array (
    0 => 10000000,
    1 => 10000,
    2 => 1000,
  ),
  255 => 
  array (
    0 => 100000000,
    1 => 10000,
    2 => 10000,
  ),
);
		return $essais;
	}

