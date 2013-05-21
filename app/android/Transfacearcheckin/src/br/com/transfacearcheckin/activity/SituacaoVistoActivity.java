package br.com.transfacearcheckin.activity;

import br.com.transfacearcheckin.ajax.SituacaoVistoAjax;
import br.com.transfacearcheckin.ajax.SolicitarVistoAjax;
import br.com.transfacearckeckin.R;
import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;

public class SituacaoVistoActivity extends Activity implements OnClickListener {
	
	private EditText matricula;
	private EditText cpf;
	private Button enviar;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.situacao_visto);
		
		this.captureViews();
		
		this.enviar.setOnClickListener(this);
		
	}
	
	private void captureViews() {
		this.matricula = (EditText) findViewById(R.id.matricula);
		this.cpf = (EditText) findViewById(R.id.cpf);
		this.enviar = (Button) findViewById(R.id.enviar);
	}
	
	public void onClick(View view) {
		
		switch (view.getId()) {
			case R.id.enviar:
				
				SituacaoVistoAjax SituacaoVisto = new SituacaoVistoAjax();
				SituacaoVisto.setActivity(this);
				SituacaoVisto.execute(
						this.matricula.getText().toString(),
						this.cpf.getText().toString()
						);
				
			break;

		
		}
	}
	
}
