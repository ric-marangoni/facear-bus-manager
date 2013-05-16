package br.com.transfacearcheckin.activity;

import java.util.ArrayList;
import java.util.List;

import br.com.transfacearckeckin.R;
import android.app.Activity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;

public class SolicitarVistoActivity extends Activity {
	
	private List<String> locais = new ArrayList<String>();
	private Spinner spinner_entrada;
	private Spinner spinner_saida;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.solicitar_visto);
		
		this.capturaViews();
		
		locais.add("Port�o");
		locais.add("CIC");
		locais.add("Pinheirinho");
		locais.add("Cap�o Raso");
		locais.add("S�tio Cercado");
		
		//Cria um ArrayAdapter usando um padr�o de layout da classe R do android, passando o ArrayList nomes
		ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, locais);
		ArrayAdapter<String> spinnerArrayAdapter = arrayAdapter;
		spinnerArrayAdapter.setDropDownViewResource(android.R.layout.simple_spinner_item);
		
		this.spinner_entrada.setAdapter(spinnerArrayAdapter);
		this.spinner_saida.setAdapter(spinnerArrayAdapter);
		
	}
	
	private void capturaViews() {
		this.spinner_entrada = (Spinner) findViewById(R.id.spinner_entrada);
		this.spinner_saida = (Spinner) findViewById(R.id.spinner_saida);
		
	}
	
}
