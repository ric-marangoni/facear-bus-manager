package br.com.transfacearcheckin.ajax;

import java.util.ArrayList;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import br.com.transfacearcheckin.lib.Ajax;
import br.com.transfacearcheckin.lib.Config;
import br.com.transfacearckeckin.R;

import android.os.AsyncTask;
import android.util.Log;
import android.view.View;
import android.webkit.WebView.FindListener;
import android.widget.ProgressBar;
import android.widget.TextView;

public class MainAjax extends AsyncTask<String, String, String> {
	
	private View view;
	private ProgressBar loading;
	private TextView periodo_solicitacao;
	
	@Override
	protected String doInBackground(String... paramss) {
			
			String retorno = "";
		
			try {
				
				ArrayList<NameValuePair> parametrosPost = new ArrayList<NameValuePair>();
				//parametrosPost.add(new BasicNameValuePair("usuario", paramss[1]));// /passa os parametros do // usuário
				//parametrosPost.add(new BasicNameValuePair("senha", paramss[2]));// /passa os parametros da senha
				
				// Simula processo...				
				retorno = Ajax.httpPost(Config.HTTP_URL + "android/getPeriodoSolicitacao", parametrosPost);
				
			} catch (Exception e) {
				e.printStackTrace();
			}
		
			return retorno;
	}

	@Override
	protected void onPostExecute(String result) {
		
		String resposta = result;
		
		this.loading = (ProgressBar) view.findViewById(R.id.loading_periodo_solicitacao);
		this.periodo_solicitacao = (TextView) view.findViewById(R.id.periodo_solicitacao);
		
		this.loading.setVisibility(this.view.INVISIBLE);
		this.periodo_solicitacao.setText(resposta);
		
		//resposta = resposta.replaceAll("\\s+", "");// /Elimina os espaços em branco
		
		if (resposta.equals("1")) {
			

		} 
		else {
			//Toast.makeText(Logar.this, "Erro ao logar",
			//Toast.LENGTH_LONG);
			//ExibirMensagem("Erro!", "Erro ao logars!");
		}
		
	}
	
	public void setView(View view) {
		this.view = view;
	}
}
