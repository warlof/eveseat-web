<?php
/*
This file is part of SeAT

Copyright (C) 2015  Leon Jacobs

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

namespace Seat\Web\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Seat\Services\Repositories\Character\CharacterRepository;

/**
 * Class CharacterSummary
 * @package Seat\Web\Http\Composers
 */
class CharacterSummary
{

    use CharacterRepository;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new character summary composer.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {

        $summary = $this->getCharacterInformation(
            $this->request->character_id);

        $characters = $this->getCharactersOnApiKey(
            $summary->keyID);

        $view->with('summary', $summary);
        $view->with('characters', $characters);

    }
}
