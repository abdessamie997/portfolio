@php
    $page_name = "messages";

    use App\Messages;
    use App\Emails;


    if(isset($_GET['deletemsg'])) {

        Messages::where('id', $_GET['deletemsg'])->delete();

        return redirect()->to($_SERVER['HTTP_REFERER'])->send();
    };

    if(isset($_GET['deletemail'])) {

        $deleteMail = Emails::where('id', $_GET['deletemail'])->delete();

        return redirect()->to($_SERVER['HTTP_REFERER'])->send();
    };


    $id = isset($_GET['read']) ? $_GET['read']: '0';
    $column = isset($_GET['read']) ? 'read': 'all';

    $get_messages = Messages::where($column, $id)->orderBy('id', 'desc')->get();

@endphp

@extends('admin/layout/master')

@section('title', 'messages')

@section('messages')

<div class="row mt">
    <div class="col-sm-3">
      <section class="panel">
        <div class="panel-body">
            <a href="?send-mail" class="btn btn-compose <?php if(isset($_GET['send-mail'])) { echo 'active'; $header_name = 'Compose Messages';}; ?>">
                <i class="fa fa-pencil"></i>  Compose Messages
            </a>
            <ul id="msg_btns" class="nav nav-pills nav-stacked mail-nav">
                <li class="<?php if( !isset($_GET['read']) && !isset($_GET['sent_emails'])) { echo 'active'; $header_name = 'Inbox (' . count($get_messages) . ')'; }; ?>"><a href="?all=0" > <i class="fa fa-inbox"></i> Inbox <span class="label label-theme pull-right inbox-notification"><?php echo count(Messages::all()); ?></span></a></li>
                <li class="<?php if( isset($_GET['read']) && $_GET['read'] == '0') { echo 'active'; $header_name = 'Unread Messages'; }; ?>"><a href="?read=0" > <i class="fa fa-envelope-o"></i>Unread Messages</a></li>
                <li class="<?php if( isset($_GET['read']) && $_GET['read'] == '1') { echo 'active'; $header_name = 'Read Messages'; }; ?>"><a href="?read=1"> <i class="fa fa-envelope-open-o"></i>Read Messages</a></li>
                <li class="<?php if( isset($_GET['sent_emails'])) { echo 'active'; $header_name = 'Sent Emails'; }; ?>"><a href="?sent_emails"><i class="fa fa-paper-plane-o"></i>Sent Emails</a></li>
            </ul>
        </div>
      </section>
    </div>
    <div class="col-sm-9">
      <section class="panel">

        <!--start open messages-->

        @if (isset($_GET['open']))

            @php
                $mes_details = Messages::find($_GET['open']);

                if($mes_details->read == '0') {
                    Messages::where('id', $_GET['open'])->update(['read' => '1']);
                }
            @endphp

        <div class="panel-body minimal">

            <div class="table-inbox-wrap messages_table">

              <div class="message_info_table">
                <div class="messages_name">
                    <span>{{ $mes_details->name }}</span>
                    <span>{{ $mes_details->email }}</span>
                </div>
                <div class="message_details_reply">
                  <a href="send_message.php?id=10">Reply <i class="fa fa-reply"></i></a>
                </div>
              </div>

              <div class="message_subject_table">
                <span>{{ $mes_details->subject }}</span>
                <span>{{ $mes_details->message }}</span>
                <span>{{ $mes_details->created_at }}</span>
              </div>

            </div>
        </div>
        <!--end open messages-->

        @else

        <header class="panel-heading wht-bg">
          <h4 class="gen-case">
              <?php echo $header_name; ?>
              <form action="#" class="pull-right mail-src-position">
                <div class="input-append">
                  <input type="text" class="form-control " placeholder="Search Mail">
                </div>
              </form>
            </h4>
        </header>

        <!-- / start send condition -->
        @if (isset($_GET['send-mail']))

        <!-- start pannel body of message-->
        <div class="panel-body">
            <div class="compose-mail">
              <form action="./send_mail" method="POST" role="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="to" class="">To:</label>
                  <input type="text" name="to" tabindex="1" id="to" class="form-control">
                  <div class="compose-options">
                    <a onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();" href="javascript:;">Cc</a>
                    <a onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();" href="javascript:;">Bcc</a>
                  </div>
                </div>

                <div class="form-group hidden">
                  <label for="cc" class="">Cc:</label>
                  <input type="text" name="cc" tabindex="2" id="cc" class="form-control">
                </div>

                <div class="form-group hidden">
                  <label for="bcc" class="">Bcc:</label>
                  <input type="text" name="bcc" tabindex="2" id="bcc" class="form-control">
                </div>

                <div class="form-group">
                  <label for="subject" class="">Subject:</label>
                  <input type="text" name="subject" tabindex="1" id="subject" class="form-control">
                </div>

                <div class="compose-editor">
                  <textarea class="wysihtml5 form-control" name="message" id="message" rows="9"></textarea>
                </div>

                <div class="compose-btn pull-right">
                    <button id="send_mail" type="submit" class="btn btn-theme btn-sm"><i class="fa fa-check"></i> Send</button>
                    <button class="btn btn-sm"><i class="fa fa-times"></i> Discard</button>
                    <button class="btn btn-sm">Draft</button>
                </div>

              </form>
            </div>
        </div>
        <!-- end pannel body of message-->
        @else

        <div class="panel-body minimal">
          <div class="mail-option">
            <div class="chk-all">
              <div class="pull-left mail-checkbox">
                <input type="checkbox" class="">
              </div>
              <div class="btn-group">
                <a data-toggle="dropdown" href="#" class="btn mini all">
                  All
                  <i class="fa fa-angle-down "></i>
                  </a>
                <ul class="dropdown-menu">
                  <li><a href="#"> None</a></li>
                  <li><a href="#"> Read</a></li>
                  <li><a href="#"> Unread</a></li>
                </ul>
              </div>
            </div>

            <div class="btn-group">
              <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                <i class=" fa fa-refresh"></i>
                </a>
            </div>

            <ul class="unstyled inbox-pagination">
              <li><span>1-50 of 99</span></li>
              <li>
                <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
              </li>
              <li>
                <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
              </li>
            </ul>
          </div>

            @if (isset($_GET['sent_emails']))

                @php
                    $get_emails = Emails::orderBy('id', 'desc')->get();
                @endphp

                @foreach ($get_emails as $emails)

                <a class="open-messages" href="?open={{ $emails->id }}">
                    <div class="table-inbox-wrap" id="messages_container" >
                        <table class="table table-inbox">
                            <tbody>

                                <tr>
                                    <td class="view-message dont-show text-left">{{ $emails->to }}</td>
                                    <td class="view-message text-right">{{ $emails->subject }}</td>
                                    <td class="view-message text-right">{{ $emails->created_at }}</td>
                                    <td class="view-message show_delete_msgs text-right">
                                        <a class="btn btn-danger btn-xs" href="?deletemail={{ $emails->id }}" ><i class="fa fa-trash fa-x3"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </a>

                @endforeach

            @else

            @foreach ($get_messages as $message)

            <a class="open-messages" href="?open={{ $message->id }}">
                <div class="table-inbox-wrap" id="messages_container" >
                    <table class="table table-inbox <?php echo $message->read == '1'? 'table-hover': 'unread'; ?>">
                        <tbody>

                            <tr>
                                <td class="view-message dont-show text-left">{{ $message->name }}</td>
                                <td class="view-message text-right">{{ $message->subject }}</td>
                                <td class="view-message text-right">{{ $message->created_at }}</td>
                                <td class="view-message show_delete_msgs text-right">
                                    <a class="btn btn-danger btn-xs" href="?deletemsg={{ $message->id }}" ><i class="fa fa-trash fa-x3"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </a>

            @endforeach

            @endif

        </div>

        @endif
        <!-- / end send condition -->

        @endif
        <!-- / end open condition -->

      </section>
    </div>
  </div>

@endsection

