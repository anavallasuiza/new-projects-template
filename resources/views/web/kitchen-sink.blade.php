@extends('web.layouts.master')

@section('content')

<div class="kitchen-sink wrapper">
    <section>

        <h1>This is the primary heading and there should only be one of these per page</h1>
        <p>A small paragraph to <em>emphasis</em> and show <strong>important</strong> bits.</p>
        <ul>
            <li>This is a list item</li>
            <li>So is this - there could be more</li>
            <li>Make sure to style list items to:
                <ul>
                    <li>Not forgetting child list items</li>
                    <li>Not forgetting child list items</li>
                    <li>Not forgetting child list items</li>
                    <li>Not forgetting child list items</li>
                </ul>
            </li>
            <li>A couple more</li>
            <li>top level list items</li>
        </ul>
        <p>Don't forget <strong>Ordered lists</strong>:</p>
        <ol>
            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
            <li>Aliquam tincidunt mauris eu risus.
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                </ol>
            </li>
            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
            <li>Aliquam tincidunt mauris eu risus.
        </ol>
        <h2>A sub heading which is not as important as the first, but is quite imporant overall</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <table>
            <tr>
                <th>Table Heading</th>
                <th>Table Heading</th>
            </tr>
            <tr>
                <td>table data</td>
                <td>table data</td>
            </tr>
            <tr>
                <td>table data</td>
                <td>table data</td>
            </tr>
            <tr>
                <td>table data</td>
                <td>table data</td>
            </tr>
            <tr>
                <td>table data</td>
                <td>table data</td>
            </tr>
        </table>

        <h3>A sub heading which is not as important as the second, but should be used with consideration</h3>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <blockquote>
            <p>“Ooh - a blockquote! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.”</p>
        </blockquote>
        <h4>A sub heading which is not as important as the second, but should be used with consideration</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <pre><code>
    #header h1 a {
        display: block;
        width: 300px;
        height: 80px;
    }
    </code></pre>
        <h5>A sub heading which is not as important as the second, but should be used with consideration</h5>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <dl>
            <dt>Definition list</dt>
            <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
            <dt>Lorem ipsum dolor sit amet</dt>
            <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
        </dl>
        <h6>This heading plays a relatively small bit part role, if you use it at all</h6>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <p>
            <button class="button">This is a regular button</button>
            <button class="button button-alt-1">Boton alternativo 1</button>
        </p>
        <div>
            <form action="#" method="post">
                <div>
                    <label for="name">Text Input:</label>
                    <input type="text" name="name" id="name" value="" tabindex="1" />
                </div>

                <div>
                    <h4>Radio Button Choice</h4>

                    <input type="radio" name="radio-choice-1" id="radio-choice-1" tabindex="2" value="choice-1" />
                    <label for="radio-choice-1">Choice 1</label>
                    <input type="radio" name="radio-choice-2" id="radio-choice-2" tabindex="3" value="choice-2" />
                    <label for="radio-choice-2">Choice 2</label>
                </div>

                <div>
                    <label for="select-choice">Select Dropdown Choice:</label>
                    <select name="select-choice" id="select-choice">
                        <option value="Choice 1">Choice 1</option>
                        <option value="Choice 2">Choice 2</option>
                        <option value="Choice 3">Choice 3</option>
                    </select>
                </div>

                <div>
                    <label for="textarea">Textarea:</label>
                    <textarea cols="40" rows="8" name="textarea" id="textarea"></textarea>
                </div>

                <div>
                    <input type="checkbox" name="checkbox" id="checkbox" />
                    <label for="checkbox">Checkbox</label>
                </div>

                <div>
                    <input type="submit" class="button" value="Submit" />
                </div>
            </form>
        </div>
        <div class="big-sizes">
            <h1>This is the primary heading and there should only be one of these per page</h1>
            <p>A small paragraph to <em>emphasis</em> and show <strong>important</strong> bits.</p>
            <ul>
                <li>This is a list item</li>
                <li>So is this - there could be more</li>
                <li>Make sure to style list items to:
                    <ul>
                        <li>Not forgetting child list items</li>
                        <li>Not forgetting child list items</li>
                        <li>Not forgetting child list items</li>
                        <li>Not forgetting child list items</li>
                    </ul>
                </li>
                <li>A couple more</li>
                <li>top level list items</li>
            </ul>
            <h2>A sub heading which is not as important as the first, but is quite imporant overall</h2>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
            <h3>This is the primary heading and there should only be one of these per page</h3>
            <p>A small paragraph to <em>emphasis</em> and show <strong>important</strong> bits.</p>
            <h4>A sub heading which is not as important as the first, but is quite imporant overall</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        </div>
        <div>
            <button class="button action-home">This is a regular button</button>
            <button class="button button-alt-1 action-home">Boton alternativo 1</button>
        </div>
        <p><a href="#" class="action-back">Go back to your seat</a></p>
    </section>
    <section class="negative">
        <p><a href="#" class="action-home">Go back to your Ford Fiesta</a></p>
        <button class="button button-alt-2 action-home">Boton alternativo 2</button>
        <h1>This is the primary heading and there should only be one of these per page</h1>
        <p>A small paragraph to <em>emphasis</em> and show <strong>important</strong> bits.</p>
        <ul>
            <li>This is a list item</li>
            <li>So is this - there could be more</li>
            <li>Make sure to style list items to:
                <ul>
                    <li>Not forgetting child list items</li>
                    <li>Not forgetting child list items</li>
                    <li>Not forgetting child list items</li>
                    <li>Not forgetting child list items</li>
                </ul>
            </li>
            <li>A couple more</li>
            <li>top level list items</li>
        </ul>
        <h2>A sub heading which is not as important as the first, but is quite imporant overall</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <h3>This is the primary heading and there should only be one of these per page</h3>
        <p>A small paragraph to <em>emphasis</em> and show <strong>important</strong> bits.</p>
        <h4>A sub heading which is not as important as the first, but is quite imporant overall</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
    </section>
</div>

@stop