using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;

namespace Servizio_Somma_Numeri
{
    /// <summary>
    /// Descrizione di riepilogo per Servizio_Somma_Numeri
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Per consentire la chiamata di questo servizio Web dallo script utilizzando ASP.NET AJAX, rimuovere il commento dalla riga seguente. 
    // [System.Web.Script.Services.ScriptService]
    public class Servizio_Somma_Numeri : System.Web.Services.WebService
    {

        [WebMethod]
        public int SommaNumeri(int Primo, int Secondo)
        {
            return Primo + Secondo;
        }
    }
}
