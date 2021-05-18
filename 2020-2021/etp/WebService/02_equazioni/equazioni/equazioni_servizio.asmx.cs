using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;

namespace equazioni
{
    /// <summary>
    /// Descrizione di riepilogo per equazioni_servizio
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Per consentire la chiamata di questo servizio Web dallo script utilizzando ASP.NET AJAX, rimuovere il commento dalla riga seguente. 
    // [System.Web.Script.Services.ScriptService]
    public class equazioni_servizio : System.Web.Services.WebService
    {

        [WebMethod]
        public string equazione(double a, double b, double c)
        {
            return a != 0 ? (-b / a).ToString()
                    : a == 0 ?
                    (b == 0 ? "indeterminata" : "impossibile")
                    : ("x1: " + ((-b + Math.Sqrt(b * b - 4 * a * c)) / 2 * a).ToString() +
                    " x2:" + ((-b - Math.Sqrt(b * b - 4 * a * c)) / 2 * a).ToString());
        }
    }
}
