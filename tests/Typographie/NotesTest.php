<?php

declare(strict_types=1);

namespace Spip\Core\Tests\Typographie;

use PHPUnit\Framework\TestCase;

class NotesTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		include_spip('public/composer');
		include_spip('inc/notes');
	}

	public function testNoteSimple(): void
	{
		$expected = "<p>a<span class=\"spip_note_ref\">&nbsp;[<a href='#nb1' class='spip_note' rel='appendix' title='b' id='nh1'>1</a>]</span></p>";
		$this->assertEquals($expected, propre('a[[b]]'));

		$expected = "<div id='nb1'>\n<p><span class=\"spip_note_ref\">[<a href='#nh1' class='spip_note' title='" . _T('info_notes') . " 1' rev='appendix'>1</a>]&nbsp;</span>b</p>\n</div>";
		$this->assertEquals($expected, calculer_notes());
		$this->viderNotes();
	}

	public function testNoteSeule(): void
	{
		$texte = propre('[[Note en bas de page]]');
		// id de la note en pied de page
		$this->assertMatchesRegularExpression('/#nb1/', $texte);
		// classe sur le lien vers le pied
		$this->assertMatchesRegularExpression('/spip_note/', $texte);
		// id du lien pour remonter ici
		$this->assertMatchesRegularExpression('/nh1/', $texte);

		// calculer les notes
		$note = calculer_notes();
		$this->assertMatchesRegularExpression('/nb1/', $note);
		$this->assertMatchesRegularExpression('/#nh1/', $note);
		$this->assertMatchesRegularExpression('/Note en bas de page/', $note);

		// vider toutes les infos de notes
		$this->viderNotes();
	}

	public function testNoteSeuleEtTexte(): void
	{
		$texte = propre('Texte avant [[Note en bas de page]] texte apres');
		$this->assertMatchesRegularExpression('/#nb1/', $texte);
		$this->assertMatchesRegularExpression('/nh1/', $texte);
		$this->assertMatchesRegularExpression('/spip_note/', $texte);
		$this->assertMatchesRegularExpression('/Texte avant/', $texte);
		$this->assertMatchesRegularExpression('/texte apres/', $texte);
		$note = calculer_notes();
		$this->assertMatchesRegularExpression('/nb1/', $note);
		$this->assertMatchesRegularExpression('/#nh1/', $note);
		$this->assertMatchesRegularExpression('/Note en bas de page/', $note);
		$this->viderNotes();
	}

	public function testNoteDoubleEtTexte(): void
	{
		$texte = propre('Texte avant [[Note en bas de page]] texte apres [[Seconde note en bas de page]]');
		$this->assertMatchesRegularExpression('/#nb1/', $texte);
		$this->assertMatchesRegularExpression('/#nb2/', $texte);
		$this->assertMatchesRegularExpression('/texte apres/', $texte);
		$note = calculer_notes();
		$this->assertMatchesRegularExpression('/Note en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Seconde note en bas de page/', $note);
		$this->viderNotes();
	}

	/**
	 * En ne vidant pas les notes les identifiant des renvois changent
	 */
	public function testNoteDoubleDeuxFoisEtDeuxCalculs(): void
	{
		$texte = propre('Texte avant [[Note en bas de page]] texte apres [[Seconde note en bas de page]]');
		$note = calculer_notes();
		$texte2 = propre('Autre avant [[Pinguin en bas de page]] autre apres [[Marmotte en bas de page]]');
		$note2 = calculer_notes();

		$this->assertMatchesRegularExpression('/#nb1/', $texte);
		$this->assertMatchesRegularExpression('/#nb2/', $texte);
		$this->assertMatchesRegularExpression('/#nb2-1/', $texte2);
		$this->assertMatchesRegularExpression('/#nb2-2/', $texte2);

		$this->assertMatchesRegularExpression('/Note en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Seconde note en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Pinguin en bas de page/', $note2);
		$this->assertMatchesRegularExpression('/Marmotte en bas de page/', $note2);

		$this->viderNotes();
	}

	/**
	 * En ne vidant pas les notes les identifiant des renvois changent
	 */
	public function testNoteDoubleDeuxFoisEtUnCalcul(): void
	{
		$texte = propre('Texte avant [[Note en bas de page]] texte apres [[Seconde note en bas de page]]');
		$texte2 = propre('Autre avant [[Pinguin en bas de page]] autre apres [[Marmotte en bas de page]]');
		$note = calculer_notes();

		$this->assertMatchesRegularExpression('/#nb1/', $texte);
		$this->assertMatchesRegularExpression('/#nb2/', $texte);
		$this->assertMatchesRegularExpression('/#nb3/', $texte2);
		$this->assertMatchesRegularExpression('/#nb4/', $texte2);

		$this->assertMatchesRegularExpression('/Note en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Seconde note en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Pinguin en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Marmotte en bas de page/', $note);

		$this->viderNotes();
	}

	public function testNoteDoubleCoupeParModele(): void
	{
		$texte = propre('Texte avant [[Note en bas de page]] <img1> [[Seconde note en bas de page]]');
		$this->assertMatchesRegularExpression('/#nb1/', $texte);
		$this->assertMatchesRegularExpression('/#nb2/', $texte);

		$note = calculer_notes();
		$this->assertMatchesRegularExpression('/Note en bas de page/', $note);
		$this->assertMatchesRegularExpression('/Seconde note en bas de page/', $note);
		$this->viderNotes();
	}

	private function viderNotes(): void
	{
		// attention a cette globale qui pourrait changer dans le temps
		$notes = charger_fonction('notes', 'inc');
		$notes('', 'reset_all');
	}
}
