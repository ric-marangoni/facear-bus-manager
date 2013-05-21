package br.com.transfacearcheckin.activity;

import br.com.transfacearcheckin.ajax.ComboLinhasAjax;
import br.com.transfacearcheckin.ajax.SolicitarVistoAjax;
import br.com.transfacearckeckin.R;
import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;

public class SolicitarVistoActivity extends Activity implements OnClickListener {
	
	private Button btn_solicitar_visto;
	private Spinner spinner_entrada;
	private Spinner spinner_saida;
	private EditText matricula; 
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.solicitar_visto);
		
		this.capturaViews();
		
		ComboLinhasAjax ComboLinhas = new ComboLinhasAjax();
		ComboLinhas.setView(getWindow().getDecorView().getRootView());
		ComboLinhas.setSpinnerLayout(android.R.layout.simple_spinner_item);
		ComboLinhas.setActivity(this);
		ComboLinhas.execute();
		
		this.btn_solicitar_visto.setOnClickListener(this);
		
	}
	
	private void capturaViews() {
		this.btn_solicitar_visto = (Button) findViewById(R.id.btn_solicitar_visto);		
		this.spinner_entrada = (Spinner) findViewById(R.id.spinner_entrada);
		this.spinner_saida = (Spinner) findViewById(R.id.spinner_saida);
		this.matricula = (EditText) findViewById(R.id.matricula);
		
	}
	
	public void onClick(View view) {
		
		switch(view.getId()) {
			case R.id.btn_solicitar_visto:
				
				SolicitarVistoAjax Solicitar = new SolicitarVistoAjax();
				Solicitar.setActivity(this);
				Solicitar.execute(
						String.valueOf(this.spinner_entrada.getSelectedItemId()), 
						String.valueOf(this.spinner_saida.getSelectedItemId()),
						this.matricula.getText().toString()
						);
				
				break;
		}
		
	} 
	
}
