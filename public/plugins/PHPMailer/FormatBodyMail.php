<?php
function formatBodyMail($name, $link)
{
    return '
    <div style=" font-family: HelveticaNeue-Light, Arial, sans-serif; background-color: #eeeeee; ">
       <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
          <tbody>
             <tr>
                <td>
                   <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width: 750px !important">
                      <tbody>
                         <tr>
                            <td>
                               <table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                  <tbody>
                                     <tr>
                                        <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 0;margin: 0;font-size: 0;line-height: 0;">
                                           <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                              <tbody>
                                                 <tr>
                                                    <td colspan="3" height="25"></td>
                                                 </tr>
                                                 >
                                                 <tr>
                                                    <td width="30"></td>
                                                    <td align="left" valign="middle" style="padding: 0;margin: 0;font-size: 0;line-height: 0;text-align: center;">
                                                       <a href="#" target="_blank"><img src="http://chanhphy.tk/assets/img/Logo-AQ-red.png" alt="logo-aq-red" height="150" /></a>
                                                    </td>
                                                    <td width="30"></td>
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </td>
                                     </tr>
                                     <tr>
                                        <td colspan="3" align="center">
                                           <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                                              <tbody>
                                                 <tr>
                                                    <td colspan="3" height="10"></td>
                                                 </tr>
                                                 <tr>
                                                    <td width="25"></td>
                                                    <td align="center">
                                                       <h1 style="font-family: HelveticaNeue-Light, arial,sans-serif;font-size: 25px;color: #404040;
                                                          line-height: 48px;
                                                          font-weight: bold;
                                                          margin: 0;
                                                          padding: 0;
                                                          ">
                                                          Arsenal Quán
                                                       </h1>
                                                    </td>
                                                    <td width="25"></td>
                                                 </tr>
                                                 <tr>
                                                    <td colspan="3" height="5"></td>
                                                 </tr>
                                                 <tr>
                                                    <td colspan="5" align="center">
                                                       <p style="
                                                          color: #404040;
                                                          font-size: 14px;
                                                          line-height: 24px;
                                                          font-weight: lighter;
                                                          padding: 0;
                                                          margin: 0;
                                                          ">
                                                          Xin chào <b>'.$name.'</b>
                                                       </p>
                                                       <p style="
                                                          color: #4e4e4e;
                                                          font-size: 13px;
                                                          line-height: 22px;
                                                          font-weight: lighter;
                                                          padding: 0;
                                                          margin: 0;
                                                          ">
                                                          Để đổi mật khẩu, hãy đảm bảo rằng bạn không tiếc lộ đường link với bất kì ai và địa chỉ email này là của bạn. Hãy click vào nút "Đổi mật khẩu" dưới đây để tiến hành cập nhật lại mật khẩu của bạn.
                                                       </p>
                                                       <br />
                                                       <p style="
                                                          color: #5e5d5d;
                                                          font-size: 12px;
                                                          font-style: italic;
                                                          line-height: 22px;
                                                          font-weight: lighter;
                                                          padding: 0;
                                                          margin: 0;
                                                          ">
                                                          *Vui lòng không trả lời email này
                                                       </p>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td colspan="4">
                                                       <div style="
                                                          width: 100%;
                                                          text-align: center;
                                                          margin: 30px 0;
                                                          ">
                                                          <table align="center" cellpadding="0" cellspacing="0" style="
                                                             font-family: HelveticaNeue-Light, Arial,
                                                             sans-serif;
                                                             margin: 0 auto;
                                                             padding: 0;
                                                             ">
                                                             <tbody>
                                                                <tr>
                                                                   <td align="center" style="
                                                                      margin: 0;
                                                                      text-align: center;
                                                                      ">
                                                                      <a href="' . $link . '" style="
                                                                         font-size: 21px;
                                                                         line-height: 22px;
                                                                         text-decoration: none;
                                                                         color: #ffffff;
                                                                         font-weight: bold;
                                                                         border-radius: 2px;
                                                                         background-color: #b81004;
                                                                         padding: 14px 40px;
                                                                         display: block;
                                                                         letter-spacing: 1.2px;
                                                                         " target="_blank">Đổi mật khẩu</a>
                                                                   </td>
                                                                </tr>
                                                             </tbody>
                                                          </table>
                                                       </div>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td colspan="3" height="10"></td>
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                               <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width: 750px !important">
                                  <tbody>
                                     <tr>
                                        <td>
                                           <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                              <tbody>
                                                 <tr>
                                                    <td colspan="2" height="30"></td>
                                                 </tr>
                                                 <tr>
                                                    <td width="360" valign="top">
                                                       <div style="
                                                          color: #a3a3a3;
                                                          font-size: 12px;
                                                          line-height: 12px;
                                                          padding: 0;
                                                          margin: 0;
                                                          ">
                                                          &copy; '.date("Y").' Arsenal Quan.
                                                       </div>
                                                       <div style="
                                                          line-height: 5px;
                                                          padding: 0;
                                                          margin: 0;
                                                          ">
                                                          &nbsp;
                                                       </div>
                                                       <div style="
                                                          color: #a3a3a3;
                                                          font-size: 12px;
                                                          line-height: 12px;
                                                          padding: 0;
                                                          margin: 0;
                                                          ">
                                                          Made in VCL-Team
                                                       </div>
                                                    </td>
                                                    <td align="right" valign="top">
                                                       <span style="line-height: 20px; font-size: 10px"><a
                                                          href="https://www.facebook.com/groups/ArsenalQuan"
                                                          target="_blank"><img
                                                          src="https://i.imgbox.com/BggPYqAh.png"
                                                          alt="fb" /></a>&nbsp;</span>
                                                       <span style="line-height: 20px; font-size: 10px"><a
                                                          href="https://twitter.com/arsquanofficial"
                                                          target="_blank"><img
                                                          src="https://i.imgbox.com/j3NsGLak.png"
                                                          alt="twit" /></a>&nbsp;</span>
                                                       <span style="line-height: 20px; font-size: 10px"><a
                                                          href="#"
                                                          target="_blank"><img
                                                          src="https://i.imgbox.com/wFyxXQyf.png"
                                                          alt="g" /></a>&nbsp;</span>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td colspan="2" height="25"></td>
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                            </td>
                         </tr>
                      </tbody>
                   </table>
                </td>
             </tr>
          </tbody>
       </table>
    </div>
    ';
}
