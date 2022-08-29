<?php

function autoriser_chaparder(string $faire, string $type, $id, array $qui, array $opt): bool {
	return true;
}

function autoriser_paschaparder(string $faire, string $type, $id, array $qui, array $opt): bool {
	return false;
}

function autoriser_chaparder_velo(string $faire, string $type, $id, array $qui, array $opt): bool {
	return true;
}

function autoriser_chaparder_carottes_dist(string $faire, string $type, $id, array $qui, array $opt): bool {
	return false;
}
function autoriser_chaparder_carottes(string $faire, string $type, $id, array $qui, array $opt): bool {
	return true;
}

function autoriser_unidentifiant(string $faire, string $type, $id, array $qui, array $opt): bool {
	return ($id === 1) ? true : false;
}
