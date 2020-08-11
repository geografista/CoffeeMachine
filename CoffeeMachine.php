<?php

class CoffeeMachine {
	
	/*
		stan kawy, szt.
		docelowo: mleko, woda, kawa itp.
	*/
	public $stanKawy = 100;
	
	/*
		stan gotówki w kasie, zł. gr.
	*/
	public $stanGotowki = 50.00;
	
	/*
		informacja o sprzedawanych napojach
	*/
	public $napoje = [
		['nazwa' => 'Cappuchino', 'cena' => 4.5], // 0.
		['nazwa' => 'Latte', 'cena' => 6.0], // 1.
	];
	
	/*
		aktualnie wybrany napój
	*/
	private $wybranyNapoj;
	
	/*
	
	*/
	public function displayInfo()
	{
		echo '<br><br>===========================================<br>';
		if ($this->stanKawy <= 0) {
			echo 'Przepraszamy. Automat nieczynny.';
		} else {
			echo 'Witamy.<br>' .
				'Dostępne napoje:<br>';
			for ($i = 0; $i < count($this->napoje); $i++) {
				echo $this->napoje[$i]['nazwa'] . ': ' . $this->napoje[$i]['cena'] . ' zł<br>';
			}
			echo 'Proszę wybrać napój.<br>===========================================<br>';
		}
	}
	
	/*
	
	*/
	public function przyjmijDyspozycje($numerNapoju)
	{
		if ($this->stanKawy <= 0) {
			echo 'Przepraszamy. Automat nieczynny.<br><br>';
			return false;
		} elseif (!isset($this->napoje[$numerNapoju])) {
			echo 'Wybrany napój nie istnieje.<br><br>';
			return false;
		}
		
		$this->wybranyNapoj = $this->napoje[$numerNapoju];
		//var_dump($this->wybranyNapoj);
		//exit;
		
		echo 'Wybrany napój: ' . $this->wybranyNapoj['nazwa'] . '.<br>' .
			'Proszę zapłacić ' . $this->wybranyNapoj['cena'] . ' zł...';
			
		return true;
	}
	
	/*
	
	*/
	public function przyjmijPieniadze($kwota)
	{
		if ($kwota <= 0) {
			echo 'Niepoprawna kwota.<br><br>';
			return false;
		} elseif ($kwota < $this->wybranyNapoj['cena']) {
			echo 'Zapłacono zbyt mało.<br><br>';
			return false;
		}
		
		$this->stanGotowki += $this->wybranyNapoj['cena'];
		$reszta = $kwota - $this->wybranyNapoj['cena'];
		
		echo '<br><br>Zapłacono: ' . $kwota . ' zł<br>';
		if ($reszta > 0) {
			$this->wydajResztę($reszta);
		}
		
		$this->przyrzadzNapoj();
		
		return true;
	}
	
	/*
		
	*/
	private function wydajResztę($reszta)
	{
		echo 'Twoja reszta: ' . $reszta . ' zł<br>';
	}
	
	/*
		
	*/
	private function przyrzadzNapoj()
	{
		// uruchamianie fizycznego procesu przyrzadzania...
		$this->stanKawy--;
		
		echo '<br><br>Odbierz swój napoj.<br>Dziękujemy :)<br><br>';
		
		$this->displayInfo();
	}
}