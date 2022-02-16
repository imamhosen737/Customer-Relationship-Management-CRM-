  @extends('layouts.app')
  @section('page_title')
      <span>View</span>
  @endsection

  @section('content')


      <div class="container wrapper">
          <a href="{{ route('project.index') }}" class="btn btn-lg btn-link">Back to Project</a>

          <div class="z-0">
              <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                  <li class="nav-item">
                      <a href="#project_overview" class="nav-link active" data-toggle="tab" role="tab" aria-controls="tab-21"
                          aria-selected="true"><span class="nav-link__count">{{ $project_count }}</span>
                          Project Overview
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('project.tasks', $id) }}" class="nav-link" aria-selected="false"><span
                              class="nav-link__count">{{ $task_count }}</span>
                          Tasks
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('project.milestones', $id) }}" class="nav-link" aria-selected="false"><span
                              class="nav-link__count">{{ $milestone_count }}</span>
                          Milestones
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#tab-23" class="nav-link" data-toggle="tab" role="tab" aria-selected="false"><span
                              class="nav-link__count">04</span>
                          Timesheets
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#tab-23" class="nav-link" data-toggle="tab" role="tab" aria-selected="false"><span
                              class="nav-link__count">05</span>
                          Files
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#tab-23" class="nav-link" data-toggle="tab" role="tab" aria-selected="false"><span
                              class="nav-link__count">06</span>
                          Discussions
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#tab-23" class="nav-link" data-toggle="tab" role="tab" aria-selected="false"><span
                              class="nav-link__count">07</span>
                          Tickets
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="#tab-24" class="nav-link disabled" data-toggle="tab" role="tab" aria-selected="false"><span
                              class="nav-link__count">0</span>
                          No Show
                      </a>
                  </li>
              </ul>



              <div class="card">
                  <div class="card-body tab-content">
                      <div class="tab-pane active show fade" id="project_overview">
                          <table class="table data_table table-bordered table-hover" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th class="col-md-2">Name</th>
                                      <th class="col-md-2">Status</th>
                                      <th class="col-md-2">Discription</th>
                                      <th class="col-md-2">Start date</th>
                                      <th class="col-md-2">End date</th>
                                      <th class="col-md-2">Company name</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <p>{{ $contacts->name }}</p>
                                      </td>
                                      <td>
                                          <p>{{ $contacts->status }}</p>
                                      </td>
                                      <td>
                                          <p>{{ $contacts->discription }}</p>
                                      </td>
                                      <td>
                                          <p>{{ $contacts->start_date }}</p>
                                      </td>
                                      <td>
                                          <p>{{ $contacts->end_date }}</p>
                                      </td>
                                      <td>
                                          <p>{{ $contacts->customer->company_name }}</p>
                                      </td>


                                  </tr>

                              </tbody>
                          </table>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  @endsection
